<style>
  .form_input {
  border: 1px solid #d1d5db; 
  outline: none; 
  border-radius: 0.375rem; 
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); 
  margin-top: 0.25rem; 
  width: 100%; 
  transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form_input:focus {
  border-color: rgb(0, 0, 0);
  box-shadow: 0 0 0 2px rgba(0, 128, 0, 0.027);
}
</style>

<section>
    <header>
        <h4 style="text-align: center;">
            Edit your profile information
        </h4>
    </header>
    
    <div id="updateProfileForm" name="updateProfileForm" class="relative overflow-x-auto flex-wrap p-10 mt-3" style="border-radius: 10px;">
    <form method="POST" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" class="" enctype="multipart\form-data">
        @csrf
        @method('put')
          <div class="flex justify-center items-center flex-col">
            <div class="flex justify-center mb-4">
                <img class="object-cover w-20 h-20 rounded-full" src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="Current profile photo" />
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
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
          </div>
            
        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <input 
                    id="first_name" 
                    name="first_name" 
                    type="text" 
                    value="{{ old('first_name', $alumni->first_name) }}" 
                    
                    autofocus 
                    autocomplete="first_name"
                    class="form_input" 
                >
                
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <input id="last_name" name="last_name" type="text" 
                class="form_input"  value="{{ old('last_name', $alumni->last_name) }}" autofocus autocomplete="last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="join_year" :value="__('Join Year')" />
                <input id="join_year" name="join_year" type="text" class="form_input"  value="{{ old('join_year', $alumni->join_year) }}" autofocus autocomplete="join_year" />
                <x-input-error class="mt-2" :messages="$errors->get('join_year')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="leave_year" :value="__('Leave Year')" />
                <input id="leave_year" name="leave_year" type="text" class="form_input" value="{{ old('leave_year', $alumni->leave_year) }}" autofocus autocomplete="leave_year" />
                <x-input-error class="mt-2" :messages="$errors->get('leave_year')" />
            </div>
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" name="email" type="email" class="form_input" value="{{ old('email', $user->email) }}" autocomplete="username" />
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
                <input id="no_hp" name="no_hp" type="text" class="form_input"  value="{{ old('no_hp', $alumni->no_hp) }}"  autofocus autocomplete="no_hp" />
                <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
            </div>
        </div>

        <div>
            <x-input-label for="linkedin" :value="__('Linkedin')" />
            <input id="linkedin" name="linkedin" type="text" class="form_input"  value="{{ old('linkedin', $alumni->linkedin) }}" autofocus autocomplete="linkedin" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="city" :value="__('City')" />
                <input id="city" name="city" type="text" class="form_input"  value="{{ old('city', $alumni->city) }}" autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="country" :value="__('Country')" />
                <input id="country" name="country" type="text" class="form_input"  value="{{ old('country', $alumni->country) }}" autofocus autocomplete="country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <input id="birthday" name="birthday" type="date" class="form_input" value="{{ old('birthday', $alumni->birthday) }}"  autofocus autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div class="flex space-x-5 my-4">
            <div class="w-1/2">
                <x-input-label for="current_company" :value="__('Current Company')" />
                <input id="current_company" name="current_company" type="text" class="form_input"  value="{{ old('current_company', $alumni->current_company) }}" autofocus autocomplete="current_company" />
                <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="current_job" :value="__('Current Job')" />
                <input id="current_job" name="current_job" type="text" class="form_input" value="{{ old('current_job', $alumni->current_job) }}"  autofocus autocomplete="current_job" />
                <x-input-error class="mt-2" :messages="$errors->get('current_job')" />
            </div>
        </div>

        <div>
            <x-input-label for="address" :value="__('address')" />
            <input id="address" name="address" type="text" class="form_input"  value="{{ old('address', $alumni->address) }}" autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <button type="submit" name="updateProfileForm" class="mt-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
    </form>
    </div>


</section>

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


