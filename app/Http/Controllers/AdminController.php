<?php

namespace App\Http\Controllers;

use App\Charts\AlumniDataChart;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Alumni;
use App\Models\Faq;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use App\Notifications\SendEmailReferral;

use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function showLoginView(): View
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('login.admin')->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        $alumniCount = \App\Models\Alumni::count();
        $faqCount = \App\Models\Faq::count();
        $referralCount = \App\Models\Referral::count();

        $alumniVerifiedCount = \App\Models\Alumni::where('status', 'verified')->count();
        $alumniNotVerifiedCount = \App\Models\Alumni::where('status', '!=', 'verified')->count();

        $faqPendingCount = \App\Models\Faq::where('status', 'pending')->count();
        $faqApprovedCount = \App\Models\Faq::where('status', 'approved')->count();
        $faqRejectedCount = \App\Models\Faq::where('status', 'rejected')->count();

        $referralPendingCount = \App\Models\Referral::where('status', 'pending')->count();
        $referralAcceptedCount = \App\Models\Referral::where('status', 'accepted')->count();
        $referralRejectedCount = \App\Models\Referral::where('status', 'rejected')->count();

        return view('admin.dashboard', compact(
            'alumniCount',
            'faqCount',
            'referralCount',
            'alumniVerifiedCount',
            'alumniNotVerifiedCount',
            'faqPendingCount',
            'faqApprovedCount',
            'faqRejectedCount',
            'referralPendingCount',
            'referralAcceptedCount',
            'referralRejectedCount'
        ));
    }


    public function ListAlumni(Request $request)
    {
        $query = Alumni::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $alumnis = Alumni::paginate(8);

        return view('admin.list-alumni', compact('alumnis'));
    }

    public function getAlumniDetails($id)
    {
        $alumni = Alumni::findOrFail($id);
        return response()->json($alumni);
    }

    public function verifyAlumni($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->status = 'verified';
        $alumni->save();

        return redirect()->back()->with('success', 'Alumni successfully verified.');
    }

    public function ListPertanyaan()
    {

        $faqs = Faq::orderBy('id', 'asc')->paginate(10);

        $pendingFaqs = Faq::where('status', 'pending')->get();

        return view('admin.list-questions', compact('faqs','pendingFaqs'));
    }

    public function verify($id)
    {
        $alumnis = Alumni::find($id);

        if ($alumnis) {
            // Update status alumni menjadi 'verified'
            $alumnis->status = 'verified';
            $alumnis->save();

            return redirect()->back()->with('success', 'Alumni successfully verified.');
        } else {
            return redirect()->back()->with('error', 'Alumni not found.');
        }
    }

    public function answerFaq(Request $request, $id)
    {
        $this->validate($request, [
            'answer' => 'required|string',
        ]);

        $faqs = Faq::findOrFail($id);

        $faqs->update([
            'answer' => $request->input('answer'),
        ]);

        return redirect()->back()->with('success', 'Answer saved successfully.');
    }
    public function approve($id)
    {
        $faqs = Faq::findOrFail($id);
        $faqs->status = 'approved';
        $faqs->save();
        return redirect()->back()->with('success', 'Question successfully approved.');
    }

    public function reject($id)
    {
        $faqs = Faq::findOrFail($id);
        $faqs->status = 'rejected';
        $faqs->save();
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditolak.');
    }
    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);
        return response()->json($alumni);
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        return redirect()->route('list-alumni')->with('success', 'Alumni deleted successfully');
    }
    public function index()
    {
        $referrals = Referral::all();
        return view('admin.list-referral', compact('referrals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $referral = Referral::findOrFail($id);
        $referral->status = $request->status;
        $referral->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }


}
