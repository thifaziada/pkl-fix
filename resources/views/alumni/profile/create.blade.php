@vite(['resources/css/app.css','resources/js/app.js'])
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complete Profile') }}
        </h2>
    </x-slot> --}}


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section>
                @auth
                    @php
                        $user = Auth::user();
                        $alumni = $user->alumni;
                    @endphp
                    @if(!$alumni)
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Complete Your Profile Information!') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("In order to verify your account, please fill in your account's profile information.") }}
                            </p>
                        </header>
        
        
                        <div id="storeProfile" name="storeProfile" class="relative overflow-x-auto bg-gray-100 p-10 mt-3" style="border-radius: 10px;">
                            <form method="POST" action="{{ route('profile.storeProfile', ['id' => Auth::user()->id]) }}" class="mt-3 space-y-3" enctype="multipart/form-data">
                                @csrf
                        
                                    {{-- <div class=" place-content-center">
                                        <div class="shrink-0">
                                            <img class="h-20 w-20 object-cover rounded-full border" src="/assets/profile_pic/profile.png" alt="Current profile photo" />
                                        </div>
                                        <div>
                                            <label for="photo">Upload Your Profile Picture</label>
                                        </div>
                
                                        <span class="sr-only">Choose profile photo</span>
                                        <input type="file" name="photo" class="block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-green-700
                                            hover:file:bg-green-100
                                        "/>
                                    </div> --}}
                
        
                                    {{-- <div class="mb-5">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">Upload Foto Profile</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="foto_help" id="foto" name="foto" type="file"@error('foto') border-red-500 @enderror>
                                        @error('foto')
                                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                        --}}
                        
                                    <div class="flex space-x-5 my-4">
                                        <div class="w-1/2 starlabel">
                                            <label for="first_name">First Name</label>
                                            <input id="first_name" name="first_name" type="text" class="mt-1 block border rounded w-full" required  />
                                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                        </div>
                                        <div class="w-1/2 starlabel">
                                            <label for="last_name">Last Name</label>
                                            <input id="last_name" name="last_name" type="text" class="mt-1 border rounded w-full"   />
                                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                        </div>
                                    </div>
                            
                                    <div class="flex space-x-5 my-4">
                                        <div class="w-1/2 starlabel">
                                            <label for="join_year">Join Year</label>
                                            <input id="join_year" name="join_year" type="text" class="mt-1 border rounded w-full"  />
                                            <x-input-error class="mt-2" :messages="$errors->get('join_year')" />
                                        </div>
                                        <div class="w-1/2 starlabel">
                                            <label for="leave_year">Leave Year</label>
                                            <input id="leave_year" name="leave_year" type="text" class="mt-1 border rounded w-full"  />
                                            <x-input-error class="mt-2" :messages="$errors->get('leave_year')" />
                                        </div>
                                    </div>
                            
                                    <div class="flex space-x-5 my-4">
                                        <div class="w-1/2">
                                            <label for="email">Email</label>
                                            <input id="email" name="email" type="email" class="mt-1 border rounded w-full" value="{{ old('email', Auth::user()->email) }}" disabled />
                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                        </div>
                                        <div class="w-1/2">
                                            <label for="no_hp">Phone Number</label>
                                            <input id="no_hp" name="no_hp" type="text" class="mt-1 border rounded w-full"   />
                                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                                        </div>
                                    </div>
                            
                                    <div>
                                        <label for="linkedin">Linkedin</label>
                                        <input id="linkedin" name="linkedin" type="text" class="mt-1 border rounded w-full"  />
                                        <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                    </div>
                
                                    <div>
                                        <label for="address">Address</label>
                                        <input id="address" name="address" type="text" class="mt-1 border rounded w-full"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>
                            
                                    <div class="flex space-x-5 my-4">
                                        <div class="w-1/2 starlabel">
                                            <label for="city">City</label>
                                            <input id="city" name="city" type="text" class="mt-1 border rounded w-full"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                        </div>
                                        <div class="w-1/2 starlabel">
                                            <label for="country">Country</label>
                                            <input id="country" name="country" type="text" class="mt-1 border rounded w-full"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('country')" />
                                        </div>
                                    </div>
                            
                                    <div>
                                        <label for="birthday">Birthday</label>
                                        <input id="birthday" name="birthday" type="date" class="mt-1 border rounded w-full" />
                                        <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                                    </div>
                            
                                    <div class="flex space-x-5 my-4">
                                        <div class="w-1/2">
                                            <label for="current_company">Current Company</label>
                                            <input id="current_company" name="current_company" type="text" class="mt-1 border rounded w-full"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
                                        </div>
                                        <div class="w-1/2">
                                            <label for="current_job">Current Job</label>
                                            <input id="current_job" name="current_job" type="text" class="mt-1 border rounded w-full" />
                                            <x-input-error class="mt-2" :messages="$errors->get('current_job')" />
                                        </div>
                                    </div>
        
                                    <div class="mb-5">
                                        <label for="photo" class="mb-1">Upload Your Profile Picture</label>
                                        <span class="sr-only">Choose profile photo</span>
                                        <input type="file" name="photo" class="block bg-gray-50 py-1 mt-1 border rounded w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-green-700
                                            hover:file:bg-green-700 hover:file:text-green-50
                                        "/>
                                        <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                    </div>
                                    
                            
                                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
                            
                            </form>
                        </div>
                    @endif
                    @if($alumni && $alumni->status == 'not verified')
                        <article class="p-5  bg-white shadow border-t border-emerald-300 ">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('You have filled your profile!') }}
                            </h2>
                            <p class="mt-1 text-mg text-gray-600 dark:text-gray-400">
                                {{ __("Please wait until we verify your account's profile information.") }}
                            </p>
                            <a href="{{ route('alumni.dashboard') }}" class="">
                                Back to dashboard
                            </a>
                        </article>

                    @endif
                @endauth
                
            
                {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form> --}}
                {{-- <div id="updateProfileForm" name="updateProfileForm" class="relative overflow-x-auto bg-gray-100 p-10 mt-3" style="border-radius: 10px;">
                <form method="POST" action="{{ route('profile.storeProfile', ['id' => Auth::user()->id]) }}" class="mt-3 space-y-3" enctype="multipart\form-data">
                    @csrf
                    @method('post')
            
                        <div class=" shrink-0">
                          <img class="h-20 w-20 object-cover rounded-full border" src="/assets/profile_pic/profile.png" alt="Current profile photo" />
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
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="first_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="last_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                    </div>
            
                    <div class="flex space-x-5 my-4">
                        <div class="w-1/2">
                            <x-input-label for="join_year" :value="__('Join Year')" />
                            <x-text-input id="join_year" name="join_year" type="text" class="mt-1 block w-full"  required autofocus autocomplete="join_year" />
                            <x-input-error class="mt-2" :messages="$errors->get('join_year')" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="leave_year" :value="__('Leave Year')" />
                            <x-text-input id="leave_year" name="leave_year" type="text" class="mt-1 block w-full"  required autofocus autocomplete="leave_year" />
                            <x-input-error class="mt-2" :messages="$errors->get('leave_year')" />
                        </div>
                    </div>
            
                    <div class="flex space-x-5 my-4">
                        <div class="w-1/2">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', Auth::user()->email)" disabled required autocomplete="username" />
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
                            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full"  autofocus autocomplete="no_hp" />
                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                        </div>
                    </div>
            
                    <div>
                        <x-input-label for="linkedin" :value="__('Linkedin')" />
                        <x-text-input id="linkedin" name="linkedin" type="text" class="mt-1 block w-full"  autofocus autocomplete="linkedin" />
                        <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"  autofocus autocomplete="address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
            
                    <div class="flex space-x-5 my-4">
                        <div class="w-1/2">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"  autofocus autocomplete="city" />
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full"  autofocus autocomplete="country" />
                            <x-input-error class="mt-2" :messages="$errors->get('country')" />
                        </div>
                    </div>
            
                    <div>
                        <x-input-label for="birthday" :value="__('Birthday')" />
                        <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"  autofocus autocomplete="birthday" />
                        <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                    </div>
            
                    <div class="flex space-x-5 my-4">
                        <div class="w-1/2">
                            <x-input-label for="current_company" :value="__('Current Company')" />
                            <x-text-input id="current_company" name="current_company" type="text" class="mt-1 block w-full"  autofocus autocomplete="current_company" />
                            <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="current_job" :value="__('Current Job')" />
                            <x-text-input id="current_job" name="current_job" type="text" class="mt-1 block w-full"  autofocus autocomplete="current_job" />
                            <x-input-error class="mt-2" :messages="$errors->get('current_job')" />
                        </div>
                    </div>
            
                    <button type="submit" name="updateProfileForm" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
            
                </form>
                </div> --}}
            
            
            </section>
        </div>
    </div>
    <style>
        .starlabel label:after {
            content:" *";
            color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this story',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-event-form').submit();
                }
            });
        }
    </script>
    @if($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ $message }}',
            confirmButtonColor: '#2ea345',
        })
    </script>
    @endif
    @if($message = Session::get('error'))
      <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ $message }}',
            confirmButtonColor: '#2ea345'
        })
      </script>
    @endif
</x-app-layout>
