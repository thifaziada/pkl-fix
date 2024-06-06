{{-- @extends('layouts.navigation')
@section('content')
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"> --}}

@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])


{{-- <div class="flex-1 min-h-screen p-4">
  @php
    $user = Auth::user();
    $alumni = $user->alumni;
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
    
  @endif --}}
    <!-- Content -->
    <div class="container mx-auto">


      <nav class="flex mt-20" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="{{ route('alumni.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <a href="{{ route('alumni.list') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Alumni</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Detail</span>
            </div>
          </li>
        </ol>
      </nav>

      <div class="max-w-md p-8 sm:flex mt-9 border-bottom-green bg-white border-l border-emerald-300 sm:space-x-6 bg-white shadow dark:bg-gray-900 dark:text-gray-100">
        <div class="flex-shrink-0 w-full mb-6 h-44 sm:h-32 sm:w-32 sm:mb-0">
          <img src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="" class="object-cover object-center w-full h-full rounded dark:bg-gray-500">
        </div>
        <div class="flex flex-col space-y-4">
          <div>
            <h2 class="text-2xl font-semibold">{{ $alumni->first_name }} {{ $alumni->last_name }}</h2>
            <span class="text-sm dark:text-gray-400">{{ $alumni->city }}, {{ $alumni->country }}</span>
          </div>
          <div class="space-y-1">
            <span class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-label="Email address" class="w-4 h-4">
                <path fill="currentColor" d="M274.6,25.623a32.006,32.006,0,0,0-37.2,0L16,183.766V496H496V183.766ZM464,402.693,339.97,322.96,464,226.492ZM256,51.662,454.429,193.4,311.434,304.615,256,268.979l-55.434,35.636L57.571,193.4ZM48,226.492,172.03,322.96,48,402.693ZM464,464H48V440.735L256,307.021,464,440.735Z"></path>
              </svg>
              <span class="dark:text-gray-400">{{ $user->email }}</span>
            </span>
            <span class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-label="Phonenumber" class="w-4 h-4">
                <path fill="currentColor" d="M449.366,89.648l-.685-.428L362.088,46.559,268.625,171.176l43,57.337a88.529,88.529,0,0,1-83.115,83.114l-57.336-43L46.558,362.088l42.306,85.869.356.725.429.684a25.085,25.085,0,0,0,21.393,11.857h22.344A327.836,327.836,0,0,0,461.222,133.386V111.041A25.084,25.084,0,0,0,449.366,89.648Zm-20.144,43.738c0,163.125-132.712,295.837-295.836,295.837h-18.08L87,371.76l84.18-63.135,46.867,35.149h5.333a120.535,120.535,0,0,0,120.4-120.4v-5.333l-35.149-46.866L371.759,87l57.463,28.311Z"></path>
              </svg>
              <span class="dark:text-gray-400">{{ $alumni->no_hp }}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="container mx-auto">
      <div class="max-w-md p-8 sm:flex mt-9 border-bottom-green bg-white border-l border-emerald-300 sm:space-x-6 bg-white shadow dark:bg-gray-900 dark:text-gray-100">
        <div class="flex flex-col space-y-4">
          <div class="space-y-3">
            <span class="flex items-center space-x-2">
              <h3 style="font-weight: bold" > Current Job : </h3>
              <span class="dark:text-gray-400">{{ $alumni->current_job }} at {{ $alumni->current_company }}</span>
            </span>
            <span class="flex items-center space-x-2">
              <h3 style="font-weight: bold"> Leave Year : </h3>
              <span class="dark:text-gray-400">{{ $alumni->leave_year }}</span>
            </span>
            <span class="flex items-center space-x-2">
              <h3 style="font-weight: bold"> Address : </h3>
              <span class="dark:text-gray-400">{{ $alumni->address }}</span>
            </span>
            <span class="flex items-center space-x-2">
              <h3 style="font-weight: bold"> Birthday : </h3>
              <span class="dark:text-gray-400">{{ $alumni->birthday }}</span>
            </span>
            <span class="flex items-center space-x-2">
              <h3 style="font-weight: bold"> Linkedin : </h3>
              <a href="{{ $alumni->linkedin }}" class="dark:text-gray-400">{{ $alumni->linkedin }}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
</div>


@endsection
