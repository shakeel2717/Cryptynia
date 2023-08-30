<?php

namespace App\Listeners;

use App\Events\ExpireUserPlanOnRoiCapReached;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlanExpiredOnRoiCapReached
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
    public function handle(ExpireUserPlanOnRoiCapReached $event): void
    {
        $user = User::find($event->user_id);
        // info("Proccess of Plan Expired for this User");

        // checking remaining cap
        $totalCap = getActivePlan($event->user_id) * 3;
        $totalEarned = networkCap($event->user_id);

        $remaining = $totalCap - $totalEarned;
        if ($remaining > 0) {
            $balanceAdjustTransaction = $user->transactions()->create([
                'type' => 'Balance Adjust',
                'sum' => true,
                'status' => true,
                'reference' => "Pacakge Expired After ROi 2x Complete",
                'user_plan_id' => $user->userPlan->id ?? null,
                'amount' => $remaining,
            ]);

            // info("Balance Adjust Transaction Added");


            $balanceRemovedTransaction = $user->transactions()->create([
                'type' => 'Balance Adjust',
                'sum' => false,
                'status' => true,
                'reference' => "Transfer Funds to Company Account",
                'user_plan_id' => $user->userPlan->id ?? null,
                'amount' => $remaining,
            ]);

            // info("Balance Adjust Transaction Removed");

            // expiring this user Plan
            $userPlan = UserPlan::find($user->userPlan->id);
            $userPlan->status = 'expired';
            $userPlan->save();

            // info("This User Plan Expired Because Of ROI");

            // Removing this Balance
        }
    }
}
