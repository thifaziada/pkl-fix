@extends('admin.layouts.navigation')

@section('content')
<div class="overflow-x-auto relative shadow-md sm:rounded-lg p-6 bg-white dark:bg-gray-900">
    <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">Referral List</h2>
    </div>
    <table class="w-full mt-6 text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">No</th>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">LinkedIn</th>
                <th scope="col" class="py-3 px-6">CV</th>
                <th scope="col" class="py-3 px-6">Status</th>
                <th scope="col" class="py-3 px-6">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($referrals as $index => $referral)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                <td class="py-4 px-6">{{ $referral->first_name }} {{ $referral->last_name }}</td>
                <td class="py-4 px-6">{{ $referral->email }}</td>
                <td class="py-4 px-6">
                    <a href="https://{{ $referral->linkedin }}" class="text-blue-600 dark:text-blue-400 hover:underline" target="_blank">{{ $referral->linkedin }}</a>
                </td>
                <td class="py-4 px-6">
                    <a href="{{ asset('storage/cv/' . $referral->cv) }}" class="text-blue-600 dark:text-blue-400 hover:underline" target="_blank">View CV</a>
                </td>
                <td class="py-4 px-6">
                    <span class="inline-block px-3 py-1 font-semibold text-xs rounded-full
                        @if($referral->status === 'Accepted') 
                            bg-green-200 text-green-800
                        @elseif($referral->status === 'Pending') 
                            bg-yellow-200 text-yellow-800
                        @elseif($referral->status === 'Rejected') 
                            bg-red-200 text-red-800
                        @else 
                            bg-gray-200 text-gray-800
                        @endif">
                        {{ $referral->status }}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <div class="flex space-x-2">
                        <form action="{{ route('referrals.updateStatus', $referral->id) }}" method="POST" class="flex items-center space-x-2 update-status-form">
                            @csrf
                            <select name="status" class="border border-gray-300 rounded p-2 bg-white dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                                <option selected>select</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            <button type="button" class="flex items-center justify-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 submit-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.submit-btn').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to update the status.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
