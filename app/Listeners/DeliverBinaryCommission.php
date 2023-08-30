<?php

namespace App\Listeners;

use App\Events\FreezeBalanceVerification;
use App\Events\PlanActivatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class DeliverBinaryCommission
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
        // Artisan::call("check:binary");
        // Artisan::call("check:reward");
        // info("Delivering Binary Commission");
        // $upliner = $event->transaction->user;
        // startDeliveringBinaryCommission:
        // // getting this user Upliner
        // $upliner = User::where('username', $upliner->refer)->first();
        // if (!$upliner) {
        //     info("This user not have any upliner");
        //     goto endThisEvent;
        // }


        // $totalMatchingBusiness = totalMatchingBusiness($upliner->id);
        // // checking if this value is not 0
        // if ($totalMatchingBusiness < 1) {
        //     info("Value is 0, Skipping");
        //     goto endThisEvent;
        // }

        // info("Value is not Zero");
        // // checking if this user have active plan
        // if ($upliner->userPlan == "") {
        //     info("Investmetn is 0");
        //     goto endThisEvent;
        // }

        // // checking if already paid
        // if ($totalMatchingBusiness <= $upliner->binary_match) {
        //     info("Already Paid");
        //     goto endThisEvent;
        // } else {
        //     $totalMatchingBusiness = $totalMatchingBusiness - $upliner->binary_match;
        // }

        // if (checkFreezeDaysCount($upliner->id)) {
        //     goto endThisEvent;
        //     die();
        // }

        // //checking networking account
        // if ($event->transaction->user->networker) {
        //     info("networker Account, Skipping Binary Commission");
        //     goto endThisEvent;
        //     die();
        // }

        // $profitRatio = $totalMatchingBusiness * $upliner->userPlan->plan->plan_profit->binary_commission / 100;
        // if ($profitRatio > 0) {
        //     // adding deposit request in the system
        //     $upliner_id = $upliner->transactions()->create([
        //         'type' => 'Binary Commission',
        //         'sum' => true,
        //         'status' => true,
        //         'user_plan_id' => $upliner->userPlan->id,
        //         'reference' => 'Binary Matching Commission From: ' . $event->transaction->user->username . ', Phone: ' . $event->transaction->user->mobile . ', Sponser: ' . $event->transaction->user->refer,
        //         'amount' => $profitRatio,
        //     ]);
        //     $user_id = $upliner_id->user_id;
        //     event(new FreezeBalanceVerification($user_id));
        //     $upliner->binary_match += $totalMatchingBusiness;
        //     $upliner->save();

        //     info("Binary Commission added for " . $upliner->username . "and Commission is: " . $profitRatio);
        //     goto startDeliveringBinaryCommission;
        // }
        // endThisEvent:
    }
}
