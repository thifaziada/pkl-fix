@extends('layouts.navigation')
@section('content')
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

<div class="flex-1 min-h-screen p-4">
    <!-- Content -->
    <div class="container mx-auto">
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






{{-- <main class="profile-page">
  <section class="relative block h-500-px">
    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('/assets/img/bgelitery.png');
          ">
      <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="relative py-16 bg-blueGray-200">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img alt="..." src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
                <button class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                  Connect
                </button>
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span class="text-sm text-blueGray-400">Friends</span>
                </div>
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span class="text-sm text-blueGray-400">Photos</span>
                </div>
                <div class="lg:mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span class="text-sm text-blueGray-400">Comments</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
              {{ $alumni->first_name }} {{ $alumni->last_name }}
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
              <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
              {{ $alumni->city }}, {{ $alumni->country }}
            </div>
            <div class="mb-2 text-blueGray-600 mt-10">
              <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>{{ $alumni->current_job }} - {{ $alumni->current_company }}
            </div>
            <div class="mb-2 text-blueGray-600">
              <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>{{ $user->email }}
            </div>
          </div>
          <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
            <div class="flex flex-wrap justify-center">
              <div class="w-full lg:w-9/12 px-4">
                <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                  An artist of considerable range, Jenna the name taken by
                  Melbourne-raised, Brooklyn-based Nick Murphy writes,
                  performs and records all of his own music, giving it a
                  warm, intimate feel with a solid groove structure. An
                  artist of considerable range.
                </p>
                <a href="#pablo" class="font-normal text-pink-500">Show more</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main> --}}
@endsection