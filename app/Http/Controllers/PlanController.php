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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.plan.create');
    }


    public function networkcap(Request $request)
    {
        // checking if this useer networking cap is full
        if (networkCapInPercentage(auth()->user()->id) == 100 || networkCapInPercentage(auth()->user()->id) > 100) {
            info("user Cap Already Full");
            // checking if this user already have active plan
            if (getActivePlan(auth()->user()->id) > 0) {
                info("User Already have Active Plan");
                info("Checking if this user trying to actiavet lower plan");
                $balance = auth()->user()->freeze_transactions->sum('amount') + balance(auth()->user()->id);
                if (getActivePlan(auth()->user()->id) > $balance) {
                    info("User trying to Activate Lower Plan");
                    return back()->withErrors(['Insufficient investment. Please allocate more than $' . getActivePlan(auth()->user()->id) . ' to activate the plan']);
                } else {
                    // getting all the freeze Balance
                    info("Delivering Freeze Balance to this useer");
                    if (auth()->user()->freeze_transactions->sum('amount') > 0) {
                        info("User have Freeze Balance: " . auth()->user()->freeze_transactions->sum('amount'));
                        foreach (auth()->user()->freeze_transactions as $freezeTransaction) {
                            $transaction = auth()->user()->transactions()->create([
                                'type' => 'Freeze Balance Recover',
                                'amount' => $freezeTransaction->amount,
                                'status' => true,
                                'sum' => true,
                                'reference' => "Balance Recover From Freeze Transactions",
                            ]);

                            if ($transaction) {
                                $freezeTransaction->delete();
                            }

                            // activating this user plan
                        }
                    }

                    // checking if this user already have active plan
                    $newAmount = auth()->user()->userPlan->amount + $balance;

                    $plan = Plan::find(getPackageByAmount($newAmount));

                    // activating user plan
                    $userPlan = auth()->user()->userPlan;
                    $userPlan->status = 'expired';
                    $userPlan->save();

                    $userPlan = new UserPlan();
                    $userPlan->user_id = auth()->user()->id;
                    $userPlan->plan_id = getPackageByAmount($newAmount);
                    $userPlan->amount = $balance;
                    $userPlan->status = 'active';
                    $userPlan->save();

                    // removing balance from user transaction
                    $transaction = auth()->user()->transactions()->create([
                        'type' => 'Plan Active',
                        'amount' => $balance,
                        'status' => true,
                        'sum' => false,
                        'user_plan_id' => $userPlan->id,
                        'reference' => "Plan: " . $plan->name . " Activated",
                    ]);

                    // activating this user
                    auth()->user()->status = 'active';
                    auth()->user()->save();

                    // Deliving Direct Commision
                    event(new PlanActivatedEvent($transaction, $userPlan));

                    return redirect()->route('user.dashboard.index')->with('success', 'Plan Activated');
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
            'amount' => 'required|numeric|min:20|max:10000000'
        ]);

        $plan = Plan::findOrFail($validatedData['plan_id']);

        // checking if this useer networking cap is full
        if (networkCapInPercentage(auth()->user()->id) >= 100) {
            info("user Cap Already Full");
            // checking if this user already have active plan
            if (getActivePlan(auth()->user()->id) > 0) {
                info("User Already have Active Plan");
                info("Checking if this user trying to actiavet lower plan");
                if (getActivePlan(auth()->user()->id) > $validatedData['amount']) {
                    info("User trying to Activate Lower Plan");
                    return back()->withErrors(['Insufficient investment. Please allocate more than $' . getActivePlan(auth()->user()->id) . ' to activate the plan']);
                }
            }
        }

        // checking if this user have enough balnace
        if (balance(auth()->user()->id) < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // checking if this user already have active plan
        if (auth()->user()->userPlan) {
            $newAmount = auth()->user()->userPlan->amount + $validatedData['amount'];

            // activating user plan
            $userPlan = auth()->user()->userPlan;
            $userPlan->plan_id = getPackageByAmount($newAmount);
            $userPlan->amount = $newAmount;
            $userPlan->status = 'active';
            $userPlan->save();
        } else {
            // activating user plan
            $userPlan = auth()->user()->userPlan()->create([
                'plan_id' => $validatedData['plan_id'],
                'amount' => $validatedData['amount'],
                'status' => 'active',
            ]);
        }


        // removing balance from user transaction
        $transaction = auth()->user()->transactions()->create([
            'type' => 'Plan Active',
            'amount' => $validatedData['amount'],
            'status' => true,
            'sum' => false,
            'reference' => "Plan: " . $plan->name . " Activated",
        ]);

        // activating this user
        auth()->user()->status = 'active';
        auth()->user()->save();

        // Deliving Direct Commision
        event(new PlanActivatedEvent($transaction, $userPlan));

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
