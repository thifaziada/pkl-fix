<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function reloadCaptcha(){
        return response()->json(['captcha' => captcha_img()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'additionalQuestion' => 'required|string',
            'captcha' => 'required'
        ]);

        Faq::create([
            'question' => $request->additionalQuestion
        ]);

        return redirect()->back()->with('success', 'Your question has been submitted successfully!');
    }
    
}
