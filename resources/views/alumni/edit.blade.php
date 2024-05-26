@extends('layouts.navigation')
@section('content')
    <div class="container">
        <h2>Edit Profile</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('alumni.update', $alumni->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="{{ $alumni->first_name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="{{ $alumni->last_name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" name="birthday" value="{{ $alumni->birthday }}" class="form-control" required>
            </div>

            <!-- Include other form fields for alumni profile here -->

            <div class="form-group">
                <label for="photo">Profile Photo:</label>
                @if($alumni->photo)
                    <img src="{{ asset('storage/' . $alumni->photo) }}" alt="Profile Photo" class="img-thumbnail mb-2" style="max-width: 200px;">
                @endif
                <input type="file" name="photo" class="form-control-file">
            </div>

            <input type="submit" value="Update Profile" class="btn btn-primary">
        </form>
    </div>
@endsection