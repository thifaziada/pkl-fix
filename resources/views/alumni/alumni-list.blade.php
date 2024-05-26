@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

<div class="flex-1 min-h-screen p-4">
    <!-- Content -->
    <div class="container mx-auto">
        {{-- <!-- Dashboard Content -->
        <h1 class="text-xl font-bold mb-4">All alumni</h1> --}}

        <form>
            <div class="flex space-x-3 my-5" >

                {{-- <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label> --}}
                <select id="category" class="bg-white border border-green-300 pl-5 text-green-600 text-sm rounded-full w-1/6 focus:ring-green-500 focus:border-green-500 block  p-2.5">
                    <option selected>Categories</option>
                    <option value="name">Name</option>
                    <option value="job">Job</option>
                    <option value="location">Location</option>
                </select>

                <div class="relative w-5/6">
                    <input type="search" name="search" placeholder="Search Name, Job, Location..." class="bg-white w-full h-10 px-4 rounded-full text-sm focus:outline-none">
                    <button type="submit" class="absolute right-5 top-2.5">
                      <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                      </svg>
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-3 gap-3">
            

            <?php foreach ($alumniStatus as $alumni): ?>
                <div class="flex flex-col max-w-md p-6 border-top-green bg-white border-t border-emerald-300 shadow dark:bg-gray-900 dark:text-gray-100">
                    <img src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="" class="flex-shrink-0 object-cover h-64 rounded-sm sm:h-96 dark:bg-gray-500 aspect-square">
                    <div>
                        <h2 class="text-xl mt-3 font-semibold">{{ $alumni->first_name }} {{ $alumni->last_name }}</h2>
                        <span class="block pb-2 text-sm dark:text-gray-400">{{ $alumni->city }}, {{ $alumni->country }}</span>
                        <div class="flex mt-4 md:mt-3">
                            <a href="{{ route('alumni.view',['id' => $alumni->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">View Profile</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="w-full max-w-sm bg-white border border-gray-200  rounded-lg shadow">
                    <div class="flex flex-col items-center py-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="profile_image"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $alumni->first_name }} {{ $alumni->last_name }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $alumni->city }}, {{ $alumni->country }}</span>
                        <div class="flex mt-4 md:mt-6">
                            <a href="{{ route('alumni.view',['id' => $alumni->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">View Profile</a>
                        </div>
                    </div>
                </div> --}}
            <?php endforeach; ?>
        </div>
    </div>
</div>


@endsection



