
@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

    <div class="flex-1 min-h-screen p-4 mt-5">
        @php
            use App\Models\Referral;
            use App\Models\Alumni;
            $user = Auth::user();
            $alumni = $user->alumni;
            $referrals = Referral::where('user_id', $user->id)->get();
        @endphp
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
        @if($alumni && $alumni->status == 'verified')
        <!-- Content -->
<div class="py-3 flex justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Recommend your acquaintances') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Recommend your acquaintances to join Elitery, and benefit from an attractive referral rewards") }}
                    </p>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <div id="referral" name="referral" class="relative overflow-x-auto bg-gray-100 p-4 sm:p-6" style="border-radius: 10px;">
                        <section class="flex flex-col gap-y-4">
                            <form method="POST" action="{{ route('referral.store') }}" class="space-y-3" enctype="multipart/form-data">
                                @csrf
                                <div class="flex space-x-5 my-4">
                                    <div class="w-1/2 starlabel">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" name="first_name" type="text" class="mt-1 block border rounded w-full" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                    </div>
                                    <div class="w-1/2 starlabel">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" type="text" class="mt-1 border rounded w-full" />
                                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                    </div>
                                </div>

                                <div class="flex space-x-5 my-4">
                                    <div class="w-1/2">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email" class="mt-1 border rounded w-full" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>

                                <div>
                                    <label for="linkedin">Linkedin Account</label>
                                    <input id="linkedin" name="linkedin" type="text" class="mt-1 border rounded w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                </div>

                                <div class="mb-5">
                                    <label for="file_cv" class="mb-1">Upload CV</label>
                                    <span class="sr-only">Choose file</span>
                                    <input type="file" name="cv" class="block bg-gray-50 py-1 mt-1 border rounded w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-green-50 file:text-green-700
                                        hover:file:bg-green-700 hover:file:text-green-50
                                    " />
                                    <x-input-error class="mt-2" :messages="$errors->get('file')" />
                                </div>

                                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>

                            </form>

                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Referral History') }}
                    </h2>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <div class="p-4 sm:p-6">
                       

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            linkedin
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            File CV
                                        </th>
                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($referrals->isEmpty())
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-white">
                                                You haven't made any referrals yet.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($referrals as $referral)
                                            <tr class="bg-white dark:bg-gray-800">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $referral->first_name }} {{ $referral->last_name }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $referral->email }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $referral->linkedin }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $referral->cv }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $referral->status }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        {{-- <div class="container mt-3">

    
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Recommend your acquaintances') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Recommend your acquaintances to join Elitery, and benefit from an attractive referral rewards") }}
                </p>
            </header>
            <div id="referral" name="referral" class="relative overflow-x-auto bg-gray-100 p-10 mt-3" style="border-radius: 10px;">
            <section class="flex flex-col col-span-3 gap-y-4">
                <form method="POST" action="{{ route('referral.store') }}" class="mt-3 space-y-3" enctype="multipart/form-data">
                    @csrf
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
                            <div class="w-1/2">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="mt-1 border rounded w-full"  />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                        </div>
                
                        <div>
                            <label for="linkedin">Linkedin Account</label>
                            <input id="linkedin" name="linkedin" type="text" class="mt-1 border rounded w-full"  />
                            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                        </div>


                        <div class="mb-5">
                            <label for="file_cv" class="mb-1">Upload CV</label>
                            <span class="sr-only">Choose file</span>
                            <input type="file" name="cv" class="block bg-gray-50 py-1 mt-1 border rounded w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-50 file:text-green-700
                                hover:file:bg-green-700 hover:file:text-green-50
                            "/>
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        
                
                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                
                </form>

            </section>


        </div> --}}
    @endif
    </div>

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
@endsection
