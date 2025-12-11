<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($status)
    {
        $this->authorize("viewAny", Penalty::class);

        $penalties = Penalty::where("status", $status)->get();

        return view('penalty/viewPenalty', compact('penalties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->authorize("payPenalty",Penalty::class);

        $validated_data = $request->validate([
            'payment_method' => 'required|string',
        ]);

        $penalty = Penalty::find($id);
        $penalty->status = 'paid';
        $penalty->pay_date = now(); // Assuming you want to set the paid_at timestamp
        $penalty->pay_librarian_id = auth()->user()->id; // Assuming you want to set the librarian who processed the payment
        $penalty->pay_method = $validated_data["payment_method"]; // Assuming you want to set the payment method
        $penalty->save();

        return redirect()->route("penalty.show","paid")->with('success', 'Penalty paid successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payPenalty($id)
    {
        $this->authorize("payPenalty",Penalty::class);

        $penalty = Penalty::find($id);

        return view('penalty/payPenalty', compact('penalty'));
    }

    public function showSelfHistory($userid)
    {

        $penalties = Penalty::whereHas('borrowRecord', function ($query) use ($userid) {
            $query->where('user_id', $userid);
        })->with('borrowRecord.book')->get();

        return view('penalty.viewSelfPenalty', compact('penalties'));

    }
}
