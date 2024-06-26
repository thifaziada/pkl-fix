@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])
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
            <div class="container mt-3">
                <h1 class="text-2xl font-bold mb-4">Alumni Stories</h1>
                <div class="grid grid-cols-3 gap-4">
                    <section class="col-span-2 flex flex-col gap-y-4">
                        @foreach($stories as $story)
                            <a href="{{ route('story.showComments', ['story_id' => $story->story_id]) }}">
                                <article class="p-5 bg-white rounded-lg shadow border-b border-emerald-300">
                                    <div class="grid grid-cols-8">
                                        {{-- Avatar --}}
                                        <div class="col-span-1">
                                            <img class="object-cover w-16 h-16 rounded-full " src="{{asset('/storage/photos/'.$story->alumni->photo)}}" alt="profile_image" />
                                        </div>
                    
                                        {{-- Thread --}}
                                        <div class="col-span-7 space-y-6 ml-4">
                                            <div class="space-y-3">
                                                <h2 class="text-xl tracking-wide">{{ $story->alumni->first_name }} {{ $story->alumni->last_name }}</h2>
                                                {{-- Date Posted --}}
                                                <div class="flex space-x-10 text-xs text-gray-500">
                                                    <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                                    @if ($story->created_at)
                                                        Posted: {{ $story->created_at->diffForHumans() }}
                                                    @else
                                                        Posted: Data waktu tidak tersedia
                                                    @endif
                                                </div>
                                                <p class="text-s">
                                                    {{ $story->story }}
                                                </p>
                                            </div>
                                            <div class="flex space-x-5 text-gray-500">
                                                <a href="{{ route('story.showComments', ['story_id' => $story->story_id]) }}" class="flex items-center space-x-2 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                    </svg>
                                                    <span class="text-xs font-bold">Comments</span>
                                                </a>
                                                @if(Auth::check() && Auth::id() == $story->user_id)
                                                <form action="{{ route('story.delete', $story->story_id) }}" method="post" class="d-inline" id="delete-event-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete()" class="text-grey-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center show_confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span class="text-xs font-bold">Delete</span>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </a>
                        @endforeach
                    </section>

                    <section class="col-span-1">
                        <form method="POST" action="{{ route('stories.create') }}" class="bg-white p-4 shadow border border-emerald-300 rounded-lg">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Share Your Story</h2>
                            <input type="text" id='story' rows="4" name='story' placeholder="Type your story..." class="bg-white w-full h-10 px-4 mb-4 rounded-full text-sm focus:outline-green" />
                            <button type="submit" name="create" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Post</button>
                        </form>
                    </section>
                </div>
            </div>
        @endif

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
    </div>
@endsection
