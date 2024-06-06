@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

<head>
  <style>
        body {
            font-family: "Poppins", sans-serif;
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
            border-left: 4px solid #4CAF50;
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
@php 
use App\Models\Testimony;
use App\Models\Alumni;

$user = Auth::user();
$alumni = $user->alumni;
$testimonies = Testimony::with('alumni')->get();
@endphp
<div class="content-body">
  <div class="card-content mb-3 p-3">
  <div class="row">
    <div class="col-lg-4">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          <div class="card-header">
            <b>Profile</b>
            <a class="float-right" href="{{ route('alumni.edit', Auth::user()->id) }}"><u><i class="bx bx-pencil"></i>edit</u></a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="{{asset('/storage/photos/'.$alumni->photo)}}" class="flex-shrink-0 object-cover aspect-square rounded-full" alt="foto">
              </div>
              <div class="col-md-8">
                <span>{{ $alumni->first_name }} {{ $alumni->last_name }}</span>
                <br>
                <span>{{ $alumni->join_year }} - {{ $alumni->leave_year }}</span>
                <br>
                <span>{{ $alumni->city }}, {{ $alumni->country }}</span>
                <br>
                <span>{{ $alumni->current_job }}, {{ $alumni->current_company}}</span>
                <br>
                <span>{{ $user->email }}</span>
                <br>
                <span>{{ $alumni->no_hp }}</span>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="flex flex-wrap justify-start mb-3">
        <div class="max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          {{-- <a href="#">
            <img class="rounded-t-lg" src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2968&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" />
          </a> --}}
          <div class="p-5">
            <a href="#">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Referrals</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Recommend your acquaintances to join Elitery, and benefit from an attractive referral rewards.</p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Read more
              <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
              </svg>
            </a>
          </div>
        </div>
      
        <div class="max-w-lg mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          {{-- <a href="#">
            <img class="rounded-t-lg" src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2968&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" />
          </a> --}}
          <div class="p-5">
            <a href="#">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Stories</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Write your stories here and stay connecting with your former colleagues.</p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Read more
              <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
              </svg>
            </a>
          </div>
        </div>
      </div>      

    </div>
    <div class="container">
      <div class="highlight">
          <div class="title">Alumni Spotlight</div>
      </div>
    </div>
      <div class="row">
        @foreach($testimonies as $testimony)
          <div class="col-md-4 mb-4 d-flex">
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 card-container p-4">
              <div class="flex flex-col items-center pb-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover aspect-square" src="{{asset('/storage/photos/'.$testimony->alumni->photo)}}" alt="Profile Image"/>
                <div class="card-body-content text-center">
                  <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $testimony->alumni->first_name }} {{ $testimony->alumni->last_name }}</h5>
                  <span class="text-sm text-gray-500 dark:text-gray-400 p-2 block">"{{ $testimony->content }}"</span>
                </div>
                <div class="mt-4">
                  <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View Profile</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>    
  </div>
  <section id="agenda" class="agenda">
    <div class="container">
      <div class="highlight">
          <div class="title">Elitery's Update</div>
      </div>
    </div>
        <div class="container" style="display: flex; text-align: center;">
          <div class="section-title" data-aos="fade-up" style="margin-top: 50px; width: 100%;">
              <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
              <div class="elfsight-app-a8a23565-b70e-4b1b-b458-d76849f29843" data-elfsight-app-lazy></div>
          </div>
        </div>
      </section>
  <div class="row">
    
  </div>  
    
  
  </section>
</div>
</div>