<?php

namespace App\Http\Controllers;

use App\Events\DirectCommissionEvent;
use App\Events\PlanActivatedEvent;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\UserPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::where('status', true)->get();
        return view('user.plan.index', compact('plans'));
    }

    public function active()
    {
        return view('user.plan.active');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.plan.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($validatedData['plan_id']);

        // checking if this user have enough balnace
        if (balance(auth()->user()->id) < $plan->price) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // adding duration days in now date
        $exp_date = now()->addDays($plan->duration);

        // activating user plan
        $userPlan = auth()->user()->userPlan()->create([
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'status' => 'active',
            'created_at' => now(),
            'expiry_date' => $exp_date,
        ]);


        // removing balance from user transaction
        $transaction = auth()->user()->transactions()->create([
            'type' => 'Plan Active',
            'amount' => $plan->price,
            'status' => true,
            'sum' => false,
            'reference' => "Plan: " . $plan->name . " Activated",
        ]);

        // activating this user
        auth()->user()->status = 'active';
        auth()->user()->save();

        // Delivering Direct Commission
        event(new PlanActivatedEvent($transaction, $userPlan));

        logHistory("User Plan Activated Successfully" . auth()->user()->username);

        return redirect()->route('user.dashboard.index')->with('success', 'Plan: ' . $plan->name . ' Activated Successfully');
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
