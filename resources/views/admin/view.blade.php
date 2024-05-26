@extends('admin.layouts.navigation')

@section('content')
<div class="container mt-10 mx-auto px-4">
    <h1 class="text-center mb-8 text-4xl font-extrabold text-gray-900 dark:text-gray-100">Alumni Details</h1>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 mb-8">
        <div class="card-content">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ $alumni->first_name }} {{ $alumni->last_name }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Email:</strong> {{ $alumni->email }}</p>
            <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Join Year:</strong> {{ $alumni->join_year }}</p>
            <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Leave Year:</strong> {{ $alumni->leave_year }}</p>
            <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Status:</strong> {{ $alumni->status }}</p>
        </div>
    </div>
</div>
@endsection

<style>
/* Add styles to match the main layout */
.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 8px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>
