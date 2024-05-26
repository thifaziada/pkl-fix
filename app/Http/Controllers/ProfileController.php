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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'join_year' => $request->join_year,
            'leave_year' => $request->leave_year,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'photo' => $fileName,
            'birthday' => $request->birthday,
            'current_company' => $request->current_company,
            'current_job' => $request->current_job,
            'no_hp' => $request->no_hp,
            'linkedin' => $request->linkedin,
            'status' => 'not verified',
        ]);
        

        return redirect()->route('profile.create')->with('success', 'Profile successfully saved. Please wait until we verify your data in maximum 3 days.');
        // // Validation rules
        // $this->validate($request, [
        //     'first_name' => 'required|string',
        //     'last_name' => 'required|string',
        //     'join_year' => 'required|numeric',
        //     'leave_year' => 'required|numeric',
        //     'address' => 'string|max:100|nullable',
        //     'city' => 'required|string',
        //     'country' => 'required|string',
        //     'photo' => 'image|mimes:jpeg,jpg,png|max:2048|nullable', // Adjust the max file size as needed
        //     'birthday' => 'date|nullable',
        //     'current_company' => 'string|nullable',
        //     'current_job' => 'string|nullable',
        //     'no_hp' => 'string|nullable',
        //     'linkedin' => 'url|nullable',
        // ]);
    
        // try {
        //     // Handle file upload
        //     $fileName = null;
        //     if ($request->hasFile('photo')) {
        //         $file = $request->file('photo');
        //         $fileName = uniqid() . '_' . $file->getClientOriginalName();
        //         $file->move(public_path('profilepic/'), $fileName);
        //     }
    
        //     // Create or update Alumni record
        //     $user = Auth::user();
    
        //     $alumni = $user->alumni ?? new Alumni;
    
        //     $alumni->fill([
        //         'id' => $user->id,
        //         'first_name' => $request->first_name,
        //         'last_name' => $request->last_name,
        //         'join_year' => $request->join_year,
        //         'leave_year' => $request->leave_year,
        //         'address' => $request->address,
        //         'city' => $request->city,
        //         'country' => $request->country,
        //         'photo' => $fileName,
        //         'birthday' => $request->birthday,
        //         'current_company' => $request->current_company,
        //         'current_job' => $request->current_job,
        //         'no_hp' => $request->no_hp,
        //         'linkedin' => $request->linkedin,
        //         'status' => 'not verified',
        //     ]);
    
        //     $alumni->save();
    
        //     return redirect()->route('dashboard')->with(['success', 'Profile successfully saved. It will be verified by admin within 3 working days.']);
        // } catch (\Exception $e) {
        //     return redirect()->route('profile.create')->with(['error', 'An error occurred. Please try again.']);
        // }
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'join_year' => 'required|number',
            'leave_year' => 'required|number',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            'photo' => 'mimes:jpeg,jpg,png',
            //'birthday' => 'required',
            //'current_company' => 'required',
            //'current_job' => 'required',
            // 'no_hp' => 'required',
            // 'linkedin' => 'required'
        ]);
    
        // Update data tanpa photo
        $alumni->update($validateData);
    
        if ($request->hasFile('photo')) {
            // Hapus photo lama
            if ($alumni->photo) {
                $oldphotoPath = 'photoProfil/' . $alumni->photo;
                if (file_exists(public_path($oldphotoPath))) {
                    unlink($oldphotoPath);
                }
            } 
        
            // Pindahkan dan rename file photo baru dengan timestamp
            $file = $request->file('photo');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            
            $$file->move(public_path('photoProfil/'), $fileName);
            $alumni->update(['photo' => $fileName]);
        }        

        if ($request->filled('password')) {
            $password = Hash::make($request->input('password'));
            $user = User::where('id', $alumni->id)->first();
            $user->update(['password' => $password]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $user = $request->user();
    //     $user->fill($request->validated());
    //     $alumni = $request->Alumni::where('id', $user->id)->first();
    //     $alumni->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $user->save();
    //     $alumni->save();


    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    // public function update(Request $request) {
    //     $user = $request->user();
    //     // $alumni = Alumni::where('id', $user->id)->first();
    //     $this->validate($request, [
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'join_year' => 'required',
    //         'leave_year' => 'required',
    //         'city' => 'required',
    //         'country' => 'required',
    //         'email' => 'required|email|unique:users,id,' . $user->id,
    //         // 'password' => 'required',
    //         'photo' => 'required|mimes:jpeg,jpg,png',
    //         'birthday' => 'required',
    //         'current_company' => 'required',
    //         'current_job' => 'required',
    //         'no_hp' => 'required',
    //         'linkedin' => 'required'
    //     ]);

    //     $user = User::with(['alumnis'])->findOrFail($user->id);
    //     $alumni = Alumni::findOrFail($user->id);

    //     if ($request->hasFile('photo')) {
    //         $file = $request->file('photo');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();

    //         $file->move('assets/images', $filename);

    //         File::delete('assets/images' . $alumni->photo);

    //         $user->update([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'join_year' => $request->join_year,
    //             'leave_year' => $request->leave_year,
    //             'city' => $request->city,
    //             'country' => $request->country,
    //             'email' => $request->email,
    //             //'password' => Hash::make($request->password),
    //             'photo' => $filename,
    //             'birthday' => $request->birhday,
    //             'current_company' => $request->current_company,
    //             'current_job' => $request->current_job,
    //             'no_hp' => $request->no_hp,
    //             'linkedin' => $request->linkedin
    //         ]);

    //         // // Jika user mengganti passwornya password 

    //         // if ($user->password != $request->password) {
    //         //     $user->update([
    //         //         'first_name' => $request->first_name,
    //         //         'last_name' => $request->last_name,
    //         //         'email' => $request->email,
    //         //         'password' => Hash::make($request->password),
    //         //         'image' => $filename,
    //         //         'gender' => $request->gender,
    //         //         'phone_number' => $request->phone_number
    //         //     ]);
    //         // } else {
    //         //     // Jika user tidak mengganti passwordnya

    //         //     $user->update([
    //         //         'name' => $request->name,
    //         //         'job_id' => $request->job_id,
    //         //         'email' => $request->email,
    //         //         'password' => $request->password,
    //         //         'image' => $filename,
    //         //         'gender' => $request->gender,
    //         //         'phone_number' => $request->phone_number
    //         //     ]);
    //         // }
    //     }

    //     return redirect(route('profile.edit', $alumni->id))->with(['success' => 'profile updated!']);
    // }

    // /**
    //  * update
    //  *
    //  * @param  mixed $request
    //  * @param  mixed $alumni
    //  * @return void
    //  */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $user = $request->user();
    //     $user->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     // Update alumni profile (assuming there is a one-to-one relationship between users and alumnis)
    //     $alumni = Alumni::where('id', $user->id)->first();
    //     $alumni->fill($request->validated());

    //     //check if image is uploaded
    //     if ($request->hasFile('photo')) {

    //         //upload new photo
    //         $photo = $request->file('photo');
    //         $timestamp = now()->timestamp;
    //         $photoPath = $photo->storeAs('public/profile_photo', $timestamp . '_' . $photo->getClientOriginalName());

    //         //delete old photo
    //         Storage::delete('public/profile_photo/'.$alumni->photo);

    //         // Update alumni with new photo path
    //         $alumni->photo = $photoPath;

    //     } 
    //     $user->save();

    //     $alumni->save();

    //     //redirect to index
    //     return redirect()->route('alumni.profile.edit')->with('status', 'profile-updated');
    // }

    // /**
    //  * Update the user's profile information.
    //  */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $user = $request->user();
    //     $user->fill($request->validated());

    //     // Update alumni profile (assuming there is a one-to-one relationship between users and alumnis)
    //     $alumni = Alumni::where('id', $user->id)->first();
    //     $alumni->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     // Handle profile photo upload
    //     if ($request->hasFile('photo')) {
    //         // Delete old photo
    //         if ($alumni->photo) {
    //             $oldPhotoPath = 'public/profile_pic/' . $alumni->photo;
    //             if (file_exists($oldPhotoPath)) {
    //                 unlink($oldPhotoPath);
    //             }
    //         }

    //         // Move and rename the new photo file with a timestamp
    //         $file = $request->file('photo');
    //         $timestamp = now()->timestamp;
    //         $fileName = $timestamp . '_' . $file->getClientOriginalName();

    //         $file->move('public/profile_pic/', $fileName);
    //         $alumni->photo = $fileName;
    //     }

    //     $user->save();
    //     $user->alumni()->save($alumni);

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }


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
