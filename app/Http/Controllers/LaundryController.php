<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function addUser() {
        return view("laundry.add-user");
    }

    public function storeUser(Request $request) {
        try {
            $selected = $request->only('name');

            $user = User::create($selected + [
                'email' => $request->only("email")['email'],
                'is_admin' => 0,
                'password' => Hash::make($request->only("password")['password'])
            ]);

            // dd($user);


            return redirect('v1/dashboard')->with('success', 'User Berhasil Dibuat');
        } catch (\Throwable $th) {
            $th->getMessage();

            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function editUser($id, Request $request)
    {
        $user = User::findOrFail($id);

    return view('laundry.edit-user', ['user' =>  $user]);

    }

    public function updateUser($id, Request $request)
    {
        $user = User::findOrFail($id);

        $selected = $request->only(['name', 'email']);

        $user->update($selected);

    return redirect(route('dashboard'))->with(['success', 'User berhasil diubah']);
    }
}
