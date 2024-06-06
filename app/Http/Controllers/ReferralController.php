<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function create()
    {
        return view('alumni.referral');
    }

    public function storeReferral(Request $request)
    {
        $user = Auth::user();

        //upload cv
        $fileName = $user->id . '_CV_' . $request->first_name . $request->last_name;
        $request->cv->storeAs('cv',$fileName,'public');

        Referral::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'linkedin' => $request->linkedin,
            'cv' => $fileName,
            'status' => 'waiting',
        ]);
        
        

        return redirect()->route('referral.create')->with('success', 'Success .');

    }
}