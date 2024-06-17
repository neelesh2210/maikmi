<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Worker;
use Illuminate\Console\Command;

class WorkerStatusCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worker-status:cron';

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
        $workers = Worker::where('is_free','0')->get();

        foreach($workers as $worker){
            $last_duration = Carbon::parse($worker->engage_time)->addMinutes($worker->engage_duration);

            $time_diff = Carbon::now()->diffInMinutes(Carbon::parse($worker->engage_time));

            if($worker->engage_duration < $time_diff){
                $worker->engage_time = null;
                $worker->engage_duration = null;
                $worker->is_free = '1';
                $worker->save();
            }
        }
    }
}
