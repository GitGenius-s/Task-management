<?php

namespace App\Console\Commands;

use App\Insights;
use Illuminate\Console\Command;

class ResetColumnValueCommandMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset column value to null for every monthly';

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
        Insights::query()->update(['monthly_completed'=>null]);
        $this->info('monthly_completed column value reset succesfully');
    }
}
