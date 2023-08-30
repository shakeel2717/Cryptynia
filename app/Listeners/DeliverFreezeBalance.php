<?php

namespace App\Listeners;

use App\Events\FreezeBalanceVerification;
use App\Events\PlanActivatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeliverFreezeBalance
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
        // info("Delivering Freeze Balance to this user");
        if ($user->freeze_transactions->sum('amount') > 0) {
            // info("User have Balance: " . $user->freeze_transactions->sum('amount'));
            foreach ($user->freeze_transactions as $freezeTransaction) {
                $transaction = $user->transactions()->create([
                    'type' => 'Freeze Balance Recover',
                    'amount' => $freezeTransaction->amount,
                    'status' => true,
                    'user_plan_id' => $user->userPlan->id,
                    'sum' => true,
                    'reference' => "Balance Recover From Freeze Transactions",
                ]);

                event(new FreezeBalanceVerification($transaction->user_id));
                if ($transaction) {
                    $freezeTransaction->delete();
                } else {
                    info("Error Deleting Freeze Transction");
                }
            }
        } else {
            // info("User not have any Balance in Freez");
        }
    }
}
