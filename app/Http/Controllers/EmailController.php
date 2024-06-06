<?php

namespace App\Http\Controllers;

use App\Mail\ReferralEmail;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendReferralEmail($referralId)
    {
        $referral = Referral::findOrFail($referralId);
        $referringUser = $referral->user;
        $toEmail = $referringUser->email;
        $message = 'Congratulations! Your referral has been accepted. You get rewards via ShopeePay. Please reply to this message by entering your phone number to claim your prize.';
        $subject = 'Referral Accepted';

        Mail::to($toEmail)->send(new ReferralEmail($message, $subject));

        $referral->save();

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
