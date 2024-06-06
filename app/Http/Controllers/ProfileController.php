<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('alumni.profile.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function storeProfile(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'join_year' => 'required|integer|min:1900|max:' . now()->year,
            'leave_year' => 'required|integer|min:1900|max:' . now()->year,
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable|date|before_or_equal:today',
            'current_company' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'linkedin' => 'nullable|url|max:255',
        ]);

        $user = Auth::user();
        $alumni = Alumni::where('id', Auth::user()->id)->first();
        if ($alumni) {
            return redirect()->route('profile.create')->with('error', 'You have filled in your profile, please wait until we verify your data.');
        }

        if($request->hasFile('photo')){
            $timestamp = now()->timestamp;
            $fileName = $timestamp . '_' . $request->photo->getClientOriginalName();
            $request->photo->storeAs('photos',$fileName,'public');
            // Auth()->user()->create(['image'=>$filename]);
        }
        else{
            $fileName = 'profile.png';
        }

        Alumni::create([
            'id' => $user->id,
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'join_year' => $validatedData['join_year'],
            'leave_year' => $validatedData['leave_year'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'photo' => $fileName,
            'birthday' => $validatedData['birthday'],
            'current_company' => $validatedData['current_company'],
            'current_job' => $validatedData['current_job'],
            'no_hp' => $validatedData['no_hp'],
            'linkedin' => $validatedData['linkedin'] ?? null,
            'status' => 'not verified',
        ]);
        

        return redirect()->route('profile.create')->with('success', 'Profile successfully saved. Please wait until we verify your data in maximum 3 days.');
        
    }
    
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $alumni = Alumni::where('id', $user->id)->first();
        return view('alumni.profile.edit', [
            'user' => $user,
            'alumni' => $alumni
        ]);
    }


    public function update(Request $request)
    {
        //dd($request->all());

        $user = Auth::user();
        $alumni = Alumni::where('id', $user->id)->first();

        if (!$alumni) {
            return redirect()->route('dashboard')->with('error', 'Profil alumni tidak ditemukan.');
        }

        $validateData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'join_year' => 'required|integer|min:1900|max:' . now()->year,
            'leave_year' => 'required|integer|min:1900|max:' . now()->year,
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable|date|before_or_equal:today',
            'current_company' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Update data tanpa photo
        $alumni->update([
            'first_name' => $validateData['first_name'],
            'last_name' => $validateData['last_name'],
            'join_year' => $validateData['join_year'],
            'leave_year' => $validateData['leave_year'],
            'address' => $validateData['address'],
            'city' => $validateData['city'],
            'country' => $validateData['country'],
            'birthday' => $validateData['birthday'],
            'current_company' => $validateData['current_company'],
            'current_job' => $validateData['current_job'],
            'no_hp' => $validateData['no_hp'],
            'linkedin' => $validateData['linkedin'] ?? null,
        ]);

        if ($request->hasFile('photo')) {
            // Hapus photo lama
            if ($alumni->photo) {
                $oldphotoPath = 'storage/photos/' . $alumni->photo;
                if (file_exists($oldphotoPath)) {
                    unlink($oldphotoPath);
                }
            } 

            // Pindahkan dan rename file photo baru dengan timestamp
            $file = $request->file('photo');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            
            $file->move('storage/photos/', $fileName);
            $alumni->photo = $fileName;
        }        

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $alumni = Alumni::where('id', $user->id)->first();

        Auth::logout();

        $user->delete();
        $alumni->delete();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
