<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class LaundryController extends Controller
{
    public function index () {
        $users = User::get();
        $transactions = $transactions = Transaction::whereBetween('created_at', [
            Carbon::now()->subDays(7),
            Carbon::now()
        ])->get();


        $revenue1Week = $transactions->sum('total');

        return view("laundry.index", ['users' => $users, 'transactions' => $transactions, 'revenue' => $revenue1Week]);
    }

    public function order() {
        return view("laundry.order");
    }
}
