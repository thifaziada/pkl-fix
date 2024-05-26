@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

    <div class="flex-1 min-h-screen p-4">
        <!-- Content -->
        <div class="container mt-5">

    
            <section class="flex flex-col col-span-3 gap-y-4">
                {{-- <small class="text-sm text-gray-400">category>discussion>topic</small> --}}

                <article class="p-5 bg-white shadow bg-white border-l border-emerald-300 shadow">
                    <div class="grid grid-cols-8">
    
                        {{-- Avatar --}}
                        <div class="col-span-1">
                            <img class="object-cover w-16 h-16 rounded" src="{{asset('/storage/photos/'.$story->alumni->photo)}}" alt="Person One" />
                        </div>
    
                        {{-- Thread --}}
                        <div class="col-span-7 space-y-6">
                            <div class="space-y-3">
                                <h2 class="text-xl tracking-wide hover:text-blue-400">{{ $story->alumni->first_name }} {{ $story->alumni->last_name }}</h2>
                                {{-- Date Posted --}}
                                <div class="flex space-x-10 text-xs text-gray-500">
                                    <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                    @if ($story->created_at)
                                        Posted: {{ $story->created_at->setTimezone('Asia/Jakarta') }}
                                    @else
                                        Posted: Data waktu tidak tersedia
                                    @endif
                                </div>
                                <p class="text-gray-500">
                                    {{ $story->story }}
                                </p>
                            </div>


                            

                </article>

                <form method="post" action="{{ route('comments.store', ['story_id' => $story->story_id]) }}">
                    @csrf
                    <input type="text" id='comment' name='comment' placeholder="Type your reply ..." class="bg-white w-4/5 h-10 px-4 rounded-full text-sm focus:outline-green" />
                    <button type="submit" name="storeComment" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm w-1/5 sm:w-auto px-5 py-2.5 text-center">Send</button>
                </form>
                            {{-- Replies --}}
                            @foreach($comments as $comment)
                            <div class="p-5 space-y-4 ml-7 text-gray-500 bg-white border-l border-emerald-300 shadow">
                                <div class="grid grid-cols-8">
                                    {{-- Avatar --}}
                                    <div class="col-span-1">
                                        <img class="object-cover w-16 h-16 rounded" src="{{asset('/storage/photos/'.$comment->alumni->photo)}}" alt="Person One" />
                                    </div>
                                    <div class="col-span-7 space-y-4">
                                        <h2 class="text-xl tracking-wide hover:text-blue-400">{{ $comment->alumni->first_name }} {{ $comment->alumni->last_name }}</h2>
                                        {{-- Date Posted --}}
                                        <div class="flex space-x-10 text-xs text-gray-500">
                                            <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                            @if ($comment->created_at)
                                                Posted: {{ $comment->created_at->setTimezone('Asia/Jakarta') }}
                                            @else
                                                Posted: Data waktu tidak tersedia
                                            @endif
                                        </div>
                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                        <div class="flex justify-between">
                                            {{-- Likes --}}
                                            <div class="flex space-x-5 text-gray-500">
                                                {{-- <a href="" class="flex items-center space-x-2">
                                                    <x-heroicon-o-heart class="w-5 h-5 text-red-300" />
                                                    <span class="text-xs font-bold">30</span>
                                                </a> --}}
                                            </div>
                
                                            {{-- Date Posted --}}
                                            {{-- <div class="flex items-center text-xs text-gray-500">
                                                <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                                Replied: {{ $comment->created_at }}
                                            </div> --}}
                                            <div class="flex space-x-5 text-gray-500">
        
                                                @if(Auth::check() && Auth::id() == $comment->user_id)
                                                <form action="#" method="post" class="d-inline" id="delete-event-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete()" class="text-grey-700  hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center show_confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg> 
                                                        <span class="text-xs font-bold">Delete</span>
                                                    </button>
                                                </form>
                                                {{-- <form method="POST" action="{{ route('story.delete', $story->story_id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger confirm-button" >Delete</button>
                                                </form> --}}
                                                {{-- <form method="POST" action="{{ route('story.destroy') }}" class="show_confirm">
                                                    @csrf
                                                    @method('delete')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                                </form>
                
                                                <form id="delete-story" action=" {{ route('story.destroy') }}" method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('delete')}}
                                                    <button type="button" onclick="confirmDelete('delete-story', $story->story_id)" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center show_confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg> 
                                                    </button>
                                                </form> --}}
                                                @endif
                
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                            @endforeach
            
                        
                        </div>
                        
                        
                    </div>

                

            </section>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this comment',
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

