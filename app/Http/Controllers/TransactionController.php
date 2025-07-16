<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::
                            where('user_id', '=', auth()->user()->id)
                            ->with('user')
                            ->get();
        // dd(Transaction::where('user_id', '=', auth()->user()->id));
        // $transactions = Transaction::with('user')->get();

        return view("laundry.listing")
                ->with('transactions', $transactions);
    }

    public function userOrder($id)
    {

        $transactions = Transaction::
                            where('user_id', '=', $id)
                            ->with('user')
                            ->get();

        $user = User::find($id);
        // dd(Transaction::where('user_id', '=', auth()->user()->id));
        // $transactions = Transaction::with('user')->get();

        return view("laundry.user-order")
                ->with('transactions', $transactions)
                ->with('user', $user);
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

            // dd($request->only('reservation_datetime')['reservation_datetime']);
            $coinPrice = 20000;

            $selectedRequest = $request->only([
                'weight',
                'quantity',
                'payment_method',
                'total',
            ]);

            $transaction = Transaction::create($selectedRequest + [
                'user_id' => auth()->user()->id,
                'approval' => false,
                'quantity' => $request->only('coin'),
                'price' => $coinPrice,
                'reservation_date' => Date::parse($request->only('reservation_datetime')['reservation_datetime'])
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
     * Update the specified resource in storage.
     */
    public function confirmOrder(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['approval' => 1]); // Example update; adjust based on your needs
        return redirect()->route('transaction.user-order', $transaction->user_id)->with('success', 'Order Confirmed Succesfully
        !');
    }
    /**
     * Update the specified resource in storage.
     */
    public function cancelOrder($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'cancelled']); // Example update; adjust based on your needs
        return redirect()->route('transaction.user-order')->with('success', 'Order cancelled successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
