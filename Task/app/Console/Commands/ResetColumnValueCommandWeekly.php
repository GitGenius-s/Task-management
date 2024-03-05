<?php

namespace App\Console\Commands;

use App\Insights;
use Illuminate\Console\Command;

class ResetColumnValueCommandWeekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset column value to null for every week';

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
     * @return mixed
     */
    public function handle()
    {
        Insights::query()->update(['weekly_completed'=>null]);
        $this->info('weekly_completed column value reset succesfully');
    }
}
