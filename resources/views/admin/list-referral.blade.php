@extends('admin.layouts.navigation')

@section('content')
<div class="overflow-x-auto relative shadow-md sm:rounded-lg p-6 bg-white dark:bg-gray-900">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">No</th>
                <th scope="col" class="py-3 px-6">User ID</th>
                <th scope="col" class="py-3 px-6">First Name</th>
                <th scope="col" class="py-3 px-6">Last Name</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">LinkedIn</th>
                <th scope="col" class="py-3 px-6">CV</th>
                <th scope="col" class="py-3 px-6">Status</th>
                <th scope="col" class="py-3 px-6">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($referrals as $index => $referral)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                <td class="py-4 px-6">{{ $referral->user_id }}</td>
                <td class="py-4 px-6">{{ $referral->first_name }}</td>
                <td class="py-4 px-6">{{ $referral->last_name }}</td>
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
                        <form action="{{ route('referrals.updateStatus', $referral->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <select name="status" class="border border-gray-300 rounded p-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Accepted" {{ $referral->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="Rejected" {{ $referral->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
