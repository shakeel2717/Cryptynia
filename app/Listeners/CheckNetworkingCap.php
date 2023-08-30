<?php

namespace App\Listeners;

use App\Events\FreezeBalanceVerification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckNetworkingCap
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
    public function handle(FreezeBalanceVerification $event): void
    {
        $user = User::find($event->user_id);
        $totalCap = getActivePlan($user->id) * 3;
        $totalEarned = networkCap($user->id);
        $diffrence = $totalEarned - $totalCap;
        // info($diffrence . " Transactions Diffrence");
        if ($diffrence > 0) {
            $user->transactions()->create([
                'type' => 'Freeze Balance',
                'sum' => false,
                'status' => true,
                'user_plan_id' => $user->userPlan->id ?? null,
                'reference' => 'User Balance Freezed',
                'amount' => $diffrence,
            ]);

            // sending this balnace to freeze
            $user->freeze_transactions()->create([
                'type' => "Freeze Balance",
                'amount' => $diffrence,
            ]);
        }
    }
}
