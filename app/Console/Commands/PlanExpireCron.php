<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\PlanPurchaseHistory;

class PlanExpireCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan-expire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $plan_purchases = PlanPurchaseHistory::where('payment_status','captured')->where('plan_status','active')->get();
        foreach($plan_purchases as $plan_purchase){
            $last_duration = Carbon::parse($plan_purchase->plan_activated_time)->addDays($plan_purchase->duration);

            $time_diff = Carbon::now()->diffInDays(Carbon::parse($plan_purchase->plan_activated_time));

            if($plan_purchase->duration < $time_diff){
                $plan_purchase->plan_status = 'expired';
                $plan_purchase->plan_expired_time = Carbon::now();
                $plan_purchase->save();

                $hold_plan_purchase = PlanPurchaseHistory::where('user_id',$plan_purchase->user_id)->where('payment_status','captured')->where('plan_status','hold')->oldest()->first();
                if($hold_plan_purchase){
                    $hold_plan_purchase->plan_status = 'active';
                    $hold_plan_purchase->plan_activated_time = Carbon::now();
                    $hold_plan_purchase->save();
                }
            }
        }
    }
}
