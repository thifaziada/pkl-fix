<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'additionalQuestion' => 'required|string',
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Faq::create([
            'question' => $request->additionalQuestion
        ]);

        return redirect()->back()->with('success', 'Your question has been submitted successfully!');
    }

    public function index()
    {
        return view('welcome');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
