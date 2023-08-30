<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        info("Observer");
        if ($transaction->sum == 'in' && $transaction->type != 'Deposit') {
            info("Good Transactoin FOund in observer");
            $user = $transaction->user;
            // checking this user if networkcap reached
            $totalCap = getActivePlan($user->id) * 3;
            $totalEarned = networkCap($user->id);
            $diffrence = $totalEarned - $totalCap;
            info($diffrence . " Observer Diffrence");
            if ($diffrence > 0) {

                $user->transactions()->create([
                    'type' => 'Freeze Balance',
                    'sum' => false,
                    'status' => true,
                    'reference' => 'User Balance Freezed',
                    'amount' => $diffrence,
                ]);


                // sending this balnace to freeze
                $user->freeze_transactions()->create([
                    'type' => $transaction->type,
                    'amount' => $diffrence,
                ]);

                info("Observer Transaction Added");
            }
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
