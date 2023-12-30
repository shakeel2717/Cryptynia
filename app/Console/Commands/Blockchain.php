<?php

namespace App\Console\Commands;

use App\Events\ExpireUserPlanOnRoiCapReached;
use App\Events\FreezeBalanceVerification;
use App\Models\PlanProfit;
use App\Models\Transaction;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Blockchain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blockchain:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delivery All Users Profit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // checking if there's any active user Plans
        $userPlans = UserPlan::where('status', 'active')->get();
        foreach ($userPlans as $userPlan) {
            info($userPlan->user->username . '\'s Active Plan Found');
            info('Plan Amount: ' . $userPlan->amount);
            info('Plan Name: ' . $userPlan->plan->name);
            
            // checking if this user plan need to exipre
            if ($userPlan->expiry_at && now() >= $userPlan->expiry_at) {
                info('Plan is about to expired.');
                // Perform actions for an expired plan, if needed
                $userPlan->status = "expired";
                $userPlan->save();

                // delivery balance to this user
                $dailyRoiTransaction = $userPlan->user->transactions()->create([
                    'type' => 'Plan Expired Refund',
                    'sum' => true,
                    'status' => true,
                    'user_plan_id' => $userPlan->id,
                    'reference' => $userPlan->plan->name . ' Plan Expired & Amount :' . number_format($userPlan->amount, 2) . "Added to Account",
                    'amount' => $userPlan->amount,
                ]);
                info($userPlan->user->name . " User Got His Refund becuase Plan is Exipred");
                goto ThisLoopEnd;
            } 


            // delivery profit to this user
            
            // checking if this user is netwoker
            if ($userPlan->user->networker) {
                info("This user is Networker, Skipping.");
                goto ThisLoopEnd;
            }

            $planProfit = $userPlan->plan->plan_profit->profit;

            // adding deposit request in the system

            $profit = $userPlan->amount * $planProfit / 100;

            // checking if this transaction already inserted
            $transactionQuery = Transaction::where('user_id', $userPlan->user_id)->where('amount', $profit)->where('user_plan_id', $userPlan->id)->where('type', 'Daily ROI')->whereDate('created_at', Carbon::today())->count();
            if ($transactionQuery > 0) {
                info("Already Delivered Skipping");
                goto ThisLoopEnd;
            }

            $dailyRoiTransaction = $userPlan->user->transactions()->create([
                'type' => 'Daily ROI',
                'sum' => true,
                'status' => true,
                'user_plan_id' => $userPlan->id,
                'reference' => $userPlan->plan->name . ' Plan & Amount :' . number_format($userPlan->amount, 2),
                'amount' => $profit,
            ]);

            info("ROI Delivered to " . $userPlan->user->username . "Successfully");

            ThisLoopEnd:
        }
        endThisCommand:
    }
}
