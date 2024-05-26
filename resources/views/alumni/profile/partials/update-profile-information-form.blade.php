@vite(['resources/css/app.css','resources/js/app.js'])

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div id="updateProfileForm" name="updateProfileForm" class="relative overflow-x-auto bg-gray-100 p-10 mt-3" style="border-radius: 10px;">
    <form method="POST" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" class="mt-3 space-y-3" enctype="multipart\form-data">
        @csrf
        @method('put')

            <div class=" shrink-0">
              <img class="object-cover w-16 h-16 rounded-full" src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="Current profile photo" />
            </div>
            <label class="block">
              <span class="sr-only">Choose profile photo</span>
              <input type="file" name="photo" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-green-50 file:text-green-700
                hover:file:bg-green-100
              "/>
            </label>


        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $alumni->first_name)" required autofocus autocomplete="first_name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $alumni->last_name)" required autofocus autocomplete="last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="join_year" :value="__('Join Year')" />
                <x-text-input id="join_year" name="join_year" type="text" class="mt-1 block w-full" :value="old('join_year', $alumni->join_year)" required autofocus autocomplete="join_year" />
                <x-input-error class="mt-2" :messages="$errors->get('join_year')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="leave_year" :value="__('Leave Year')" />
                <x-text-input id="leave_year" name="leave_year" type="text" class="mt-1 block w-full" :value="old('leave_year', $alumni->leave_year)" required autofocus autocomplete="leave_year" />
                <x-input-error class="mt-2" :messages="$errors->get('leave_year')" />
            </div>
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="w-1/2">
                <x-input-label for="no_hp" :value="__('Phone Number')" />
                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $alumni->no_hp)" required autofocus autocomplete="no_hp" />
                <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
            </div>
        </div>

        <div>
            <x-input-label for="linkedin" :value="__('Linkedin')" />
            <x-text-input id="linkedin" name="linkedin" type="text" class="mt-1 block w-full" :value="old('linkedin', $alumni->linkedin)" required autofocus autocomplete="linkedin" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $alumni->city)" required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $alumni->country)" required autofocus autocomplete="country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $alumni->birthday)" required autofocus autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="current_company" :value="__('Current Company')" />
                <x-text-input id="current_company" name="current_company" type="text" class="mt-1 block w-full" :value="old('current_company', $alumni->current_company)" required autofocus autocomplete="current_company" />
                <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="current_job" :value="__('Current Job')" />
                <x-text-input id="current_job" name="current_job" type="text" class="mt-1 block w-full" :value="old('current_job', $alumni->current_job)" required autofocus autocomplete="current_job" />
                <x-input-error class="mt-2" :messages="$errors->get('current_job')" />
            </div>
        </div>

        <button type="submit" name="updateProfileForm" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>


        {{-- <div class="flex items-center gap-4">
            
            <x-secondary-button>{{ __('Save') }}</x-secondary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div> --}}
    </form>
    </div>


</section>

{{-- @section('content')

<div class="flex-1 min-h-screen p-4">  
    <!-- Content -->
  
    <div class="container mx-auto p-2"> <!-- Added p-4 for padding -->
      
  
      <div class="container mx-auto">
        <h1 class="font-bold text-xl mb-4">Edit Profil alumni</h1>
      </div>
      <div class=" w-full items-center"> <!-- Use flex container to align content in the same line -->
       
        <div> <!-- Add more additional content as needed -->
          
            <!-- Your second additional content here -->
        </div>
          
      </div>
      <div id="editProfileForm" name="editprofile" class="relative overflow-x-auto bg-gray-100 p-10" style="border-radius: 10px;">
        <form class="max-w-sm mx-auto" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart\form-data">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">first_name</label>
            <input type="text" id="first_name" name="first_name" aria-label="first_name" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('first_name',$alumni->first_name) }}" disabled>
          </div>
          <div class="mb-5">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">last_name</label>
            <input type="text" id="last_name" name="last_name" aria-label="last_name" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('last_name',$alumni->last_name) }}" disabled>
          </div>
          <div class="mb-5">
            <label for="join_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">join_year</label>
            <input type="text" id="join_year" name="join_year" aria-label="join_year" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('join_year',$alumni->join_year) }}" disabled>
          </div>
          <div class="mb-5">
            <label for="leave_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">leave_year</label>
            <input type="text" id="leave_year" name="leave_year" aria-label="leave_year" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('leave_year',$alumni->leave_year) }}" disabled>
          </div>
          <div class="mb-5">
            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
            <input type="text" id="birthday" name="birthday" aria-label="birthday" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('birthday',$alumni->birthday) }}" disabled>
          </div>
          <div class="mb-5">
            <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Handphone</label>
            <input type="text" id="no_hp" name="no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ old('no_hp',$alumni->no_hp) }}" value="{{ old('no_hp',$alumni->no_hp) }}" required @error('no_hp') border-red-500 @enderror>
            @error('no_hp')
              <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">address</label>
            <input type="text" id="address" name="address" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ old('address',$alumni->address) }}" value="{{ old('address',$alumni->address) }}" required @error('address') border-red-500 @enderror>
            @error('address')
              <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">address</label>
            <input type="text" id="address" name="address" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ old('address',$alumni->address) }}" value="{{ old('address',$alumni->address) }}" required @error('address') border-red-500 @enderror>
            @error('address')
              <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">Upload Foto Profile</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="foto_help" id="foto" name="foto" type="file"@error('foto') border-red-500 @enderror>
            @error('foto')
              <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update password</label>
            <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
          </div>
  
  
        
          <button type="submit" name="editprofile" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>
        </form>
         
      </div>
      
  </div>
  </div>
  
  </div>
  
  @endsection --}}
