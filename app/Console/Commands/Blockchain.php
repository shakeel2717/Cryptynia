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
        // checking if today is saturday or sunday
        if (Carbon::today()->format('D') == "Sat" || Carbon::today()->format('D') == "Sun") {
            info("Today is Holdiy");
            goto endThisCommand;
        }
        // checking if there's any active user Plans
        $userPlans = UserPlan::where('status', 'active')->get();
        foreach ($userPlans as $userPlan) {
            info($userPlan->user->username . '\'s Active Plan Found');
            info('Plan Amount: ' . $userPlan->amount);
            info('Plan Name: ' . $userPlan->plan->name);
            // delivery profit to this user

            // checking if this user is netwoker
            if ($userPlan->user->networker) {
                info("This user is Networker, Skipping.");
                goto ThisLoopEnd;
            }

            $planProfit = $userPlan->plan->plan_profit->profit;

            // adding deposit request in the system
            // checking if this transaction already inserted
            $transactionQuery = Transaction::where('user_id', $userPlan->user_id)->where('type', 'Daily ROI')->whereDate('created_at', Carbon::today())->count();
            if ($transactionQuery > 0) {
                info("Already Delivered Skipping");
                goto ThisLoopEnd;
            }

            // checking if this user is eligible for more then 2x



            if (checkFreezeDaysCount($userPlan->user_id)) {
                goto ThisLoopEnd;
            }

            if (!checkLeftRightActiveStatus($userPlan->user_id)) {
                // checking 2x roicap for roi only
                if (totalDailyRoiCap($userPlan->user_id) <= totalRoi($userPlan->user_id)) {
                    info("User Total ROI Cap: " . totalDailyRoiCap($userPlan->user_id));
                    info("User Total ROI: " . totalRoi($userPlan->user_id));
                    $user_id = $userPlan->user_id;
                    info("This User DailyROI Cap Reached");
                    event(new ExpireUserPlanOnRoiCapReached($user_id));
                    goto ThisLoopEnd;
                }
            }


            // checking if RoiCap Will Reached after this profit
            $profit = $userPlan->amount * $planProfit / 100;

            if (!checkLeftRightActiveStatus($userPlan->user_id)) {
                info("This user Not Elible For More then 2x Daily ROI");
                if (totalDailyRoiCap($userPlan->user_id) <= ($profit + totalRoi($userPlan->user_id))) {
                    info("This User DailyROI Cap Reached.");
                    $profit = totalDailyRoiCap($userPlan->user_id) - totalRoi($userPlan->user_id);
                }
            }


            $dailyRoiTransaction = $userPlan->user->transactions()->create([
                'type' => 'Daily ROI',
                'sum' => true,
                'status' => true,
                'user_plan_id' => $userPlan->id,
                'reference' => $userPlan->plan->name . ' Plan & Amount :' . number_format($userPlan->amount, 2),
                'amount' => $profit,
            ]);
            event(new FreezeBalanceVerification($userPlan->user->id));
            info("ROI Delivered to " . $userPlan->user->username . "Successfully");

            ThisLoopEnd:
        }
        endThisCommand:
    }
}
