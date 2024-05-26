<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\User;
use Brick\Math\BigInteger;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    // /**
    //  * Display the alumni list.
    //  */
    // public function index(Request $request): View
    // {
    //     return view('alumni', [
    //         'user' => $request->user(),
    //     ]);
    // }
    public function list_alumni(Request $request)
    {
        $alumniData = Alumni::all();

        // Check if there's a search query
        if ($request->has('search')) {
            $search = $request->input('search');
            $alumniData = Alumni::where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('current_job', 'like', "%{$search}%")
                ->orWhere('current_company', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                ->orWhere('country', 'like', "%{$search}%")
                ->get();
        }

        $alumniStatus = Alumni::where('status', 'verified')->get();

        return view('alumni.alumni-list', compact('alumniData', 'alumniStatus'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $alumni = Alumni::where('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->orWhere('current_job', 'like', "%{$search}%")
            ->orWhere('current_company', 'like', "%{$search}%")
            ->orWhere('city', 'like', "%{$search}%")
            ->orWhere('country', 'like', "%{$search}%")
            ->paginate();

        return view('alumni.alumni-list', ['alumni' => $alumni]);
    }
    public function viewAlumniDetails($id)
    {
        // Retrieve alumni and user data based on user_id
        $alumni = Alumni::where('id', $id)->first();

        // Check if alumni with the given user_id exists
        if (!$alumni) {
            abort(404); 
        }

        // Retrieve additional user information
        $user = User::where('id', $id)->first();

        // Pass alumni and user data to the view
        return view('alumni.alumni-view', compact('alumni', 'user'));
    }
}