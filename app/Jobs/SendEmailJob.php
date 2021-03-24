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
        // dd($users);
        // $minute = 0;
        // $count = count($this->send_mail);

        // foreach($users as $user) {
            /* if($count % 4 === 0) {
                $minute;
            } */
            // $users = [
            //     ['email'=>'muhammad.aji.putra.mp98@gmail.com'],
            //     ['email'=>'muhammad.aji.putra.19@gmail.com']
            // ];
            $minute = 0;
            // $users = ['muhammad.aji.putra.mp98@gmail.com','muhammad.aji.putra.19@gmail.com'];

            // $users = 'muhammad.aji.putra.mp98@gmail.com';

            // sparate the all users into x users
            $recipient_count = 3;
            $sparated_user = [];
            $i = 0;
            foreach($users as $key=>$user){
                if($key % $recipient_count == 0){
                    $i++;
                    array_push($sparated_user, [$user]);
                }
                // if($)
                else{
                    // array_push($sparated_user[1][1], [$user]);
                    // $sparated_user[0][0] = 'test';
                    // dd($i-1);
                    if($i <= count($sparated_user))
                    {
                        array_push($sparated_user[$i-1], $user);
                    }
                }
            }

            // dd($sparated_user);


            //send email
            foreach($sparated_user as $recipient){
                if(!empty($recipient)){
                    Mail::to($recipient)->later(now()->addMinutes($minute), new SendEmailDemo());
                }
            }

            // dd($sparated_user);
            // dd($users);
            // Mail::to($users)->later(now()->addMinutes($minute), new SendEmailDemo());
            // $count++;
        // }
    }
}
