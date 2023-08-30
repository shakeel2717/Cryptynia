<?php

namespace App\Console\Commands;

use App\Events\FreezeBalanceVerification;
use App\Models\User;
use Illuminate\Console\Command;

class checkBinaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:binary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver All Users Binary to Users if missing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('status', 'active')->get();
        foreach ($users as $user) {
            // info("Delivering Binary Commission");
            $totalMatchingBusiness = totalMatchingBusiness($user->id);
            // checking if this value is not 0
            if ($totalMatchingBusiness < 1) {
                // info("Value is 0, Skipping");
                goto endLoop;
            }

            // info("Matching Balance Value is not Zero");
            // checking if this user have active plan
            if ($user->userPlan == "") {
                // info("Investmetn is 0");
                goto endLoop;
            }
            // checking if already paid
            if ($totalMatchingBusiness <= $user->binary_match) {
                // info("Already Paid");
                goto endLoop;
            } else {
                $totalMatchingBusiness = $totalMatchingBusiness - $user->binary_match;
            }

            if (checkFreezeDaysCount($user->id)) {
                goto endLoop;
                die();
            }

            $profitRatio = $totalMatchingBusiness * $user->userPlan->plan->plan_profit->binary_commission / 100;
            if ($profitRatio > 0) {
                // adding deposit request in the system
                $user_id = $user->transactions()->create([
                    'type' => 'Binary Commission',
                    'sum' => true,
                    'status' => true,
                    'user_plan_id' => $user->userPlan->id,
                    'reference' => 'Binary Matching Commission From: ' . $user->username . ', Phone: ' . $user->mobile . ', Sponser: ' . $user->refer,
                    'amount' => $profitRatio,
                ]);
                $user_id = $user_id->user_id;
                event(new FreezeBalanceVerification($user_id));
                $user->binary_match += $totalMatchingBusiness;
                $user->save();

                // info("Binary Commission added for " . $user->username . "and Commission is: " . $profitRatio);
            }

            endLoop:
        }
    }
}
