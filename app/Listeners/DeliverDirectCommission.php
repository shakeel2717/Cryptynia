<?php

namespace App\Listeners;

use App\Events\FreezeBalanceVerification;
use App\Events\PlanActivatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeliverDirectCommission
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PlanActivatedEvent $event): void
    {
        $user = User::find($event->transaction->user_id);
        $transaction = $event->transaction;
        $userPlan = $event->userPlan;
        // getting this user upliner
        if ($user->refer != 'default') {
            // info("User have valid refer");

            // finding the refer
            $sponser = User::where('username', $user->refer)->first();
            if (!$sponser) {
                goto EndThisListener;
                die();
            }

            // checking if sponser is active
            if ($sponser->status != 'active') {
                goto EndThisListener;
                die();
            }

            if (checkFreezeDaysCount($sponser->id)) {
                goto EndThisListener;
                die();
            }

            // checking networker account
            if ($user->networker) {
                // info("Networker Account, Skipping Direct Profit");
                goto EndThisListener;
            }

            // getting direct commission
            $amount = $transaction->amount * $sponser->userPlan->plan->plan_profit->direct_commission / 100;

            $thisSponser = $sponser->transactions()->create([
                'type' => "Direct Commission",
                'sum' => true,
                'amount' => $amount,
                'user_plan_id' => $sponser->userPlan->id,
                'status' => true,
                'reference' => 'Direct Commision from: ' . $user->username,
            ]);
            $user_id = $thisSponser->user_id;
            event(new FreezeBalanceVerification($user_id));
        }

        EndThisListener:
    }
}
