<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.finance.index');
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
            'username' => 'required|string|exists:users,username',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|string',
            'add' => 'required|boolean',
        ]);

        $user = User::where('username', $validatedData['username'])->firstOrFail();

        // adding balance to this user
        $transaction = $user->transactions()->create([
            'type' => $validatedData['type'],
            'sum' => $validatedData['add'],
            'amount' => $validatedData['amount'],
            'status' => true,
            'reference' => 'Admin Action',
        ]);

        // checking if this transaction is Daily ROI
        if ($validatedData['type'] == 'Daily ROI') {

            // getting this user Active Plan
            if ($user->userPlan) {
                $transaction->user_plan_id = $user->userPlan->id;
                $transaction->save();
            }
        }

        return back()->with('success', 'Balance Adjust Succesfully');
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
