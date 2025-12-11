<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class BookController extends Controller
{
    private $validate = [
        "title"=>"required|unique:books,title",
        "author"=>"required|array",
        "category"=>"required|array",
        "book_cover"=>"required|image|mimes:png,jpeg,jpg,svg",
        "description" => "required|string",
    ];

    private function updateValidate($id)
    {
        return [
            "title" => "required|unique:books,title," . $id,
            "author" => "required|array",
            "category" => "required|array",
            "book_cover" => "nullable|image|mimes:png,jpeg,jpg,svg",
            "description" => "required|string",
        ];
    }

    public function menu(Request $request){
        //Get all categories
        $categories = Category::all();

        //Get all books based on selected category
        $selectedCategory = $request->query('category');
        if ($selectedCategory){
            $books = Book::whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.name', $selectedCategory);
            })->get();
        }else{
            $books = Book::all(); //show all books if no category is selected
        }

        return view('menu.menu', compact('books', 'categories', 'selectedCategory'));
    }

    public function home(){
        //Fetch books for the latest 10 books
        $newBooks = Book::orderBy('created_at', 'desc')->limit(10)->get();

        //Fetch all categories with their books
        $categories = Category::with('books')->limit(8)->get();

        return view ('home.home', compact('newBooks', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Book::class);
        $books = Book::all();
        return view('book/viewBook', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create", Book::class);
        $authors = Author::all();
        $categories = Category::all();

        return view('book/createBook',compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create", Book::class);
        $validatedData = $request->validate($this->validate);
        $path = $request->book_cover->store('book_covers','public');
        $validatedData['book_cover'] = $path;

        foreach($validatedData['author'] as $key => $author_name){
            $author = Author::firstOrCreate(['name' => $author_name]);
            $validatedData['author'][$key] = $author->id;
        };

        $book = Book::create(
            [
                "title"=>$validatedData["title"],
                "description"=>$validatedData["description"],
                "book_cover"=>$validatedData["book_cover"],
            ]
        );

        $book->authors()->attach($validatedData['author']);
        $book->categories()->attach($validatedData['category']);
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $categories = Category::all();
        return view('book/showBook', compact('book', 'authors', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize("update", Book::class);
        $book = Book::find($id);
        $authors = Author::all();
        $categories = Category::all();

        return view('book/editBook', compact('book', 'authors', 'categories'));
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
        $this->authorize("update", Book::class);
        $validatedData = $request->validate($this->updateValidate($id));
        $book = Book::find($id);

       // Check if a new book cover is uploaded
        if ($request->hasFile('book_cover')) {
        // Delete old book cover if it exists
            if ($book->book_cover)
            {
                Storage::disk('public')->delete($book->book_cover); // Deletes the old file from the public drive
            }

            // Store the new book cover
            $validatedData['book_cover'] = $request->file('book_cover')->store('book_covers','public');
        }

        foreach($validatedData['author'] as $key => $author_name){
            $author = Author::firstOrCreate(['name' => $author_name]);
            $validatedData['author'][$key] = $author->id;
        }

        $book->update(
            [
                "title" => $validatedData["title"],
                "description" => $validatedData["description"],
                "book_cover" => $validatedData["book_cover"] ?? $book->book_cover,
            ]
        );

        // Update authors and categories
        $book->authors()->sync($validatedData['author']);
        $book->categories()->sync($validatedData['category']);

        return redirect()->route('book.show', $book->id)->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("delete", Book::class);
        Book::destroy($id);
        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }

    public function searchBook(Request $request)
    {
        $searchTerms = $request->input('searchTerm');
        $results = [];

        if ($searchTerms) {
            $results = Book::where('title', 'LIKE', '%' . $searchTerms . '%')
                            ->orWhereHas('authors', function($query) use ($searchTerms) {
                                $query->where('name', 'LIKE', '%' . $searchTerms . '%');
                            })
                            ->get();
        }

        return view("searchResult/searchResult",compact('results'));
    }

}
