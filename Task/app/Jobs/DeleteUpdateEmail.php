<?php

namespace App\Jobs;

use App\Mail\UpdatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteUpdatedMail;

class DeleteUpdateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $array;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->array=$array;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to($this->array['user_email'])->send(new DeleteUpdateEmail($this->array));
        Mail::to($this->array['user_email'])->send(new DeleteUpdatedMail($this->array));
    }
}
