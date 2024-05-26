@extends('layouts.navigation')
@section('content')

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
  
  @endsection
