<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdatedMail;

class UpdateEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $array;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->array = $array;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $arr = $this->array;
        Mail::to($arr['user_email'])->cc('admin@example.com')->send(new UpdatedMail($arr));
    }
}
