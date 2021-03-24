<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailDemo;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail)
    {
        $this->send_mail = $send_mail;
        // dd($send_mail);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->send_mail;
        // dd(count($this->send_mail));

        $minute = 0;
        $count = count($this->send_mail);

        foreach($users as $user) {
            if($count % 5 === 0) {
                $minute++;
            }
            Mail::to($user)->later(now()->addMinutes($minute), new SendEmailDemo($user));
            $count++;
        }
    }
}
