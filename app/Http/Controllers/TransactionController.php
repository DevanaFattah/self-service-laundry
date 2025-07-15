<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('user')->get();



        return view("laundry.listing")
                ->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("laundry.order");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // dd($request);
            $coinPrice = 20000;

            $selectedRequest = $request->only([
                'weight',
                'quantity',
                'payment_method',
                'reservation_date',
                'total',
            ]);

            $transaction = Transaction::create($selectedRequest + [
                'user_id' => auth()->user()->id,
                'approval' => false,
                'quantity' => $request->only('coin'),
                'price' => $coinPrice
            ]);

            return redirect()->route('transaction.index');    

        } catch (\Throwable $th) {
            throw $th;
            // return $th->getMessage();  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::find($id);

        return view('laundry.edit')->with('transaction', $transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $selectedRequest = $request->only([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
