<?php

namespace App\Http\Controllers;

use App\Mail\ReferralEmail;
use App\Models\Announcement;
use App\Models\User;
use App\Notifications\SendEmailReferral;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // public function sendRewardReferral()
    // {
    //     $user=User::all();

    //     $details=[
    //         'greeting'=>'Congrats',
    //         'body'=>'You get reward',
    //         'actiontext'=>'subscribe',
    //         'actionurl'=>'/',
    //         'lastline'=>'lastline',
    //     ];

    //     // Notification::send($user, new SendEmailReferral($details));

    //     dd('done');
    // }

    // public function store(Request $request) {
    //     $announcement = Announcement::create([
    //         'title' => $request->title,
    //         'description' => $request->description
    //     ]);

    //     return response()->json($announcement);
    // }

    public function sendReferralEmail(){
        $toEmail = 'thifazia13@gmail.com';
        $message = 'Congratulations!';
        $subject = 'Referral Email';

        $response = Mail::to($toEmail)->send(new ReferralEmail($message, $subject));

        dd($response);
    }

}
