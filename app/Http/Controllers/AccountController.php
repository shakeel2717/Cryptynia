<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'account_number' => 'required|string',
            'account_title' => 'required|string',
            'bank_name' => 'required|string',
        ]);

        $account = Account::updateOrCreate([

            'user_id' => auth()->user()->id,
        ], [
            'bank_name' => $validatedData['bank_name'],
            'account_number' => $validatedData['account_number'],
            'account_title' => $validatedData['account_title'],
        ]);

        return back()->with('success', 'Record Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
