<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SentEmailController extends Controller
{
    public function sentEmail(Request $request)
    {
        // cara 1
        $send_mail = $request->email;

        // $emailSent = [];

        /* foreach ($send_mail as $i => $email) {
            $emailSent[] = new User([$email]);
        } */

        // $send_mail = saveMany($emailSent);

        // dd($send_mail);
        dispatch(new SendEmailJob($send_mail));

        dd($send_mail);
        // return $send_mail;

    // cara 2 /* with out queue */
        /* Mail::send('email.demo', [], function($message) use ($send_mail)
            {
                $message->to($send_mail)->subject('This is test e-mail');
            });
        var_dump(Mail::failures());
        exit; */

        // using queue
        /* $users = User::all();
        $count = 0;
        $hours = 0;

        foreach($users as $user) {

        if($count % 100 === 0) {
            $hours++;
            }

            Mail::to($user)->later(now()->addHours($hours), new MyEmail($user));
            $count++;
        } */
    }

}
