@extends('admin.layouts.navigation')

@section('content')
<div class="container mx-auto py-5">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">Admin Management FAQ</h2>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">No</th>
                        <th scope="col" class="py-3 px-6">Question</th>
                        <th scope="col" class="py-3 px-6">Answer Status</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6 text-center">Answer Column</th>
                        <th scope="col" class="py-3 px-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">{{ $faq->id }}</td>
                        <td class="py-4 px-6">{{ $faq->question }}</td>
                        <td class="py-4 px-6">
                            @if($faq->answer)
                                <span class="text-green-600 dark:text-green-400">Answered</span>
                            @else
                                <span class="text-red-600 dark:text-red-400">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ $faq->status }}</td>
                        <td class="py-4 px-6 text-center">
                            @if (!$faq->answer)
                            <form action="{{ route('admin.answer.faq', $faq->id) }}" method="post" class="submit-answer-form">
                                @csrf
                                <textarea name="answer" rows="2" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter answer here..."></textarea>
                                <button type="submit" class="mt-2 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 submit-answer-button">Submit Answer</button>
                            </form>
                            @else
                            <div class="text-gray-900 dark:text-white">{{ $faq->answer }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.approve.faq', $faq->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 approve-button">Approve</a>
                                <a href="{{ route('admin.reject.faq', $faq->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 reject-button">Reject</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    // SweetAlert for Submit Answer
    document.querySelectorAll('.submit-answer-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit this answer?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // SweetAlert for Approve
    document.querySelectorAll('.approve-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const url = button.getAttribute('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this FAQ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // SweetAlert for Reject
    document.querySelectorAll('.reject-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const url = button.getAttribute('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to reject this FAQ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap');

body {
    font-family: 'Nunito Sans', sans-serif;
    background-color: #f8f9fa;
}

h2 {
    color: #343a40;
}

.bg-white {
    background-color: #fff;
}

.bg-gray-800 {
    background-color: #2d3748;
}

.shadow-lg {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.transition {
    transition: all 0.3s ease-in-out;
}

.hover\:shadow-xl:hover {
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
}

.table-responsive {
    overflow-x: auto;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
}

.styled-table th, .styled-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.styled-table th {
    background-color: #f0f0f0;
    color: #333;
    font-weight: 600;
    text-align: center;
}

.styled-table tbody tr {
    transition: background-color 0.3s, transform 0.3s;
}

.styled-table tbody tr:hover {
    background-color: #f1f1f1;
    transform: scale(1.02);
}

.answer-textarea {
    width: 100%;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 8px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.answer-textarea:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 8px 16px;
    margin-top: 8px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #367c39;
}

.btn-group {
    display: flex;
    gap: 8px;
}

.btn-group a {
    padding: 8px 16px;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
}

.btn-success {
    background-color: #28a745;
    transition: background-color 0.3s;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: #dc3545;
    transition: background-color 0.3s;
}

.btn-danger:hover {
    background-color: #c82333;
}
</style>
