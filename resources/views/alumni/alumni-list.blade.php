@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

<head>
    <style>
        body {
            /* font-family: "Poppins", sans-serif; */
        }
        .container {
            padding: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .highlight {
            border-bottom: 4px solid #4CAF50;
            padding-left: 10px;
        }
        .content {
            font-size: 18px;
        }
        .green-color {
          color: #4CAF50;
        }
    </style>
</head>

<div class="flex-1 min-h-screen p-4 mt-5">
    @php
        $user = Auth::user();
        $alumni = $user->alumni;
    @endphp
    @if($alumni && $alumni->status == 'not verified')
        <article class="p-5 bg-white shadow border-t border-emerald-300">
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
        
        <div class="container mx-auto">
            <div class="container">
                <div class="highlight">
                    <div class="title">Alumni</div>
                </div>
            </div>

            <form action="{{ route('alumni.search') }}" method="GET">
                <div class="flex flex-wrap gap-4 mb-6">
                    <div class="w-full md:w-1/2 lg:w-1/4">
                        <select id="category" name="category" class="block w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select an option</option>
                            <option value="name">Name</option>
                            <option value="join_year">Join Year</option>
                            <option value="leave_year">Leave Year</option>
                            <option value="city">City</option>
                            <option value="country">Country</option>
                            <option value="current_job">Current Job</option>
                            <option value="current_company">Current Company</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3">
                        <input type="text" id="search" name="search" placeholder="Type your search here..." class="block w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-4 gap-4">
                @foreach ($alumniStatus as $alumni)
                    <div class="flex flex-col max-w-md p-6 border-top-green bg-gray-100 border-t border-emerald-300 shadow dark:bg-gray-900 dark:text-gray-100">
                        <img src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="" class="flex-shrink-0 object-cover rounded-m sm:h-30 dark:bg-gray-500 aspect-square">
                        <div>
                            <h2 class="text-xl mt-3 font-semibold">{{ $alumni->first_name }} {{ $alumni->last_name }}</h2>
                            <span class="block pb-2 text-sm dark:text-gray-400">{{ $alumni->city }}, {{ $alumni->country }}</span>
                            <div class="flex mt-4 md:mt-3">
                                <a href="{{ route('alumni.view',['id' => $alumni->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">View Profile</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    @endif
</div>

@endsection
