<?php

namespace App\Console\Commands;

use App\Insights;
use Illuminate\Console\Command;

class ResetColumnValueCommandQuartly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:quartly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset column value to null for every quartly';

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
        Insights::query()->update(['quartly_completed'=>null]);
        $this->info('quartly_completed column value reset succesfully');
    }
}
