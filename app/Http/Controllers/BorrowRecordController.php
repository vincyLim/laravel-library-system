<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Penalty;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class BorrowRecordController extends Controller
{
    private $validate = [
        'user_id' => 'required|integer',
        'book_id' => 'required|integer',
    ];

    protected $paginationTheme = 'bootstrap';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowRecords = BorrowRecord::with(['user', 'book'])->get();
        return view('borrowRecord.viewBorrowRecord', compact('borrowRecords'));
    }

    public function requesting()
    {
        $this->authorize('viewAny', BorrowRecord::class);

        $borrowRecords = BorrowRecord::with(['user', 'book'])->getRequesting()->get();
        return view('borrowRecord.viewBorrowRecord', compact('borrowRecords'));
    }

    public function borrowing()
    {
        $this->authorize('viewAny', BorrowRecord::class);

        $borrowRecords = BorrowRecord::with(['user', 'book'])->getBorrowing()->get();
        return view('borrowRecord.viewBorrowRecord', compact('borrowRecords'));
    }

    public function returned()
    {
        $this->authorize('viewAny', BorrowRecord::class);

        $borrowRecords = BorrowRecord::with(['user', 'book'])->getReturned()->get();
        return view('borrowRecord.viewBorrowRecord', compact('borrowRecords'));
    }

    public function overdue()
    {
        $this->authorize('viewAny', BorrowRecord::class);

        $borrowRecords = BorrowRecord::with(['user', 'book'])->getOverdue()->get();
        return view('borrowRecord.viewBorrowRecord', compact('borrowRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $borrowRecords = BorrowRecord::with('book','penalty')->where("user_id", auth()->id());
        $borrowRecords = $this->filter($request, $borrowRecords);
        $borrowRecords = $borrowRecords->paginate(5);

        return view('borrowRecord.viewBorrowHistory',  compact("borrowRecords"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrowRecord = BorrowRecord::find($id);
        $borrowRecord->delete();

        $book = Book::find($borrowRecord->book_id);
        $book->update([
            "status" => "available",
        ]);

        return redirect()->back()->with('success', 'Request deleted');
    }

    public function borrowRequest($id)
    {
        if(Gate::allows("allowToBorrow"))
        {
            $borrowRecord = BorrowRecord::create([
                "user_id" => auth()->id(),
                "book_id" => $id,
            ]);

            $book = Book::find($id);
            $book->update([
                "status" => "requested",
            ]);

            return redirect()->back()->with('success', 'Borrow request created successfully.');
        }
    }

    public function approveRequest($id)
    {
        $this->authorize('approve_borrow_and_return_book',BorrowRecord::class);

        $borrowRecord = BorrowRecord::find($id);

        $borrowRecord->update([
            'librarian_id' =>  auth()->id(),
            'start_date' => now(),
            'end_date' => now()->addDays(7),
        ]);

        $borrowRecord->book->update([
            "status" => "borrowed",
        ]);

        return redirect()->route('borrowRecord.borrowing')->with('success', 'Borrow request approve successfully.');
    }

    public function returnBook($id)
    {
        $this->authorize('approve_borrow_and_return_book',BorrowRecord::class);

        $borrowRecord = BorrowRecord::find($id);

        $borrowRecord->update([
            'return_date' => now(),
            'return_librarian_id' => auth()->id(),
        ]);

        if($borrowRecord->return_date > $borrowRecord->end_date) {
            $daysOverdue = $borrowRecord->return_date->diffInDays($borrowRecord->end_date);
            $penaltyAmount = $daysOverdue * 5; // Assuming a penalty of 5 currency units per day
            Penalty::create([
                'user_id' => $borrowRecord->user_id,
                'borrow_record_id' => $borrowRecord->id,
                'amount' => $penaltyAmount,
                'status' => 'unpaid',
                
            ]);
        }

        $borrowRecord->book->update([
            "status" => "available",
        ]);

        if($borrowRecord->isOverdue())
        {
            return redirect()->route('borrowRecord.overdue')->with('success', 'Book returned successfully, but it is overdue. Penalty applied.');
        }
        else
        {
            return redirect()->route('borrowRecord.returned')->with('success', 'Book returned successfully.');
        }
    }

    public function filter(Request $request, $query)
    {        
        // Filter by status
        $status = $request->input('status');

        if ($status) 
        {
            if ($status == "requesting") 
            {
                $query = $query->getRequesting();
            } 
            elseif ($status == "borrowing") 
            {
                $query = $query->getBorrowing();
            } 
            elseif ($status == "returned") 
            {
                $query = $query->getReturned();
            } 
            elseif ($status == "overdue") 
            {
                $query = $query->getOverdue();
            }
        }
        
        // Filter by book name
        $bookName = $request->input('book_name');
        if ($bookName) 
        {
            $query = $query->whereHas('book', function($q) use ($bookName) {
                $q->where('title', 'like', '%' . $bookName . '%');
            });
        }
        
        // Filter by borrow date range
        $borrowDateStart = $request->input('borrow_date_start');
        $borrowDateEnd = $request->input('borrow_date_end');
        
        if ($borrowDateStart && $borrowDateEnd) 
        {
            $query = $query->whereBetween('start_date', [$borrowDateStart, $borrowDateEnd]);
        } 
        elseif ($borrowDateStart) 
        {
            $query = $query->where('start_date', '>=', $borrowDateStart);
        } 
        elseif ($borrowDateEnd) 
        {
            $query = $query->where('start_date', '<=', $borrowDateEnd);
        }
        
        // Filter by return date range
        $returnDateStart = $request->input('return_date_start');
        $returnDateEnd = $request->input('return_date_end');
        
        if ($returnDateStart && $returnDateEnd) 
        {
            $query = $query->whereBetween('return_date', [$returnDateStart, $returnDateEnd]);
        } 
        elseif ($returnDateStart) 
        {
            $query = $query->where('return_date', '>=', $returnDateStart);
        } 
        elseif ($returnDateEnd) 
        {
            $query = $query->where('return_date', '<=', $returnDateEnd);
        }
        
        // Filter by due date range
        $dueDateStart = $request->input('due_date_start');
        $dueDateEnd = $request->input('due_date_end');
        
        if ($dueDateStart && $dueDateEnd) 
        {
            $query = $query->whereBetween('end_date', [$dueDateStart, $dueDateEnd]);
        } 
        elseif ($dueDateStart) 
        {
            $query = $query->where('end_date', '>=', $dueDateStart);
        } 
        elseif ($dueDateEnd) 
        {
            $query = $query->where('end_date', '<=', $dueDateEnd);
        }
        
        // Get the filtered results
        return $query->orderBy("created_at", "desc");
    }
}
