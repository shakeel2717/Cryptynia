<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferFundsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.transfer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|exists:users,username',
            'amount' => 'required|numeric|min:5|max:100000',
        ]);

        // checking if thi user have enough balance
        // checking if this user have enough balance
        if (balance(auth()->user()->id) < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }


        $targetuser = User::where('username', $validatedData['username'])->firstOrFail();
        DB::transaction(function () use ($validatedData, $targetuser) {


            // adding balance to this user
            $transaction = $targetuser->transactions()->create([
                'type' => "Funds Transfer",
                'sum' => true,
                'amount' => $validatedData['amount'],
                'status' => true,
                'reference' => auth()->user()->username . " Transfer to your account",
            ]);

            // removing balance form logged in user
            $transaction = auth()->user()->transactions()->create([
                'type' => "Funds Transfer",
                'sum' => false,
                'amount' => $validatedData['amount'],
                'status' => true,
                'reference' => "you Transfer Funds to " . $targetuser->username,
            ]);
        });

        logHistory("User Transfer Funds to " . $targetuser->username . " amount: " . $validatedData['amount']);

        return back()->with('success', 'Funds Successfully Transfer to ' . $targetuser->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
