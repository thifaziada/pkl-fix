@extends('admin.layouts.navigation')

@section('content')
<div class="container mt-4 mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-3xl font-semibold mb-6 text-gray-900 dark:text-gray-100">Admin Management of Alumni Accounts</h2>
        <div class="mb-6">
            <div class="flex flex-wrap gap-4 mb-6">
                <div class="w-full md:w-1/2 lg:w-1/4">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                        Category:
                    </label>
                    <select id="category" class="block w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select an option</option>
                        <option value="name">Name</option>
                        <option value="join_year">Join Year</option>
                        <option value="leave_year">Leave Year</option>
                    </select>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                        Search:
                    </label>
                    <input type="text" id="search" placeholder="Type your search here..." class="block w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">No</th>
                            <th scope="col" class="py-3 px-6">Name</th>
                            <th scope="col" class="py-3 px-6">Email</th>
                            <th scope="col" class="py-3 px-6">Join Year</th>
                            <th scope="col" class="py-3 px-6">Leave Year</th>
                            <th scope="col" class="py-3 px-6">Status</th>
                            <th scope="col" class="py-3 px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($alumnis as $alumni)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                            <td class="py-2 px-4">{{ $alumni->id }}</td>
                            <td class="py-2 px-4">{{ $alumni->first_name }} {{ $alumni->last_name }}</td>
                            <td class="py-2 px-4">{{ $alumni->email }}</td>
                            <td class="py-2 px-4">{{ $alumni->join_year }}</td>
                            <td class="py-2 px-4">{{ $alumni->leave_year }}</td>
                            <td class="py-2 px-4">
                                @if ($alumni->status != 'verified')
                                <a href="#" onclick="verifyAlumni({{ $alumni->id }})" class="btn btn-primary">Verify</a>
                                @else
                                <span class="status-verified">Verified</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 flex gap-2">
                                <button class="btn btn-warning" onclick="openModal({{ $alumni->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.alumni.destroy', ['id' => $alumni->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this alumni?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $alumnis->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="alumniModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white dark:bg-gray-800 transition-transform transform -translate-y-full opacity-0">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Alumni Details</h3>
            <div class="mt-4">
                <p id="alumniDetails" class="text-sm text-gray-500 dark:text-gray-400 text-left"></p>
            </div>
            <div class="mt-4">
                <button id="closeModal" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const categoryDropdown = document.getElementById("category");
    const searchInput = document.getElementById("search");

    searchInput.addEventListener("input", () => {
        filterData(categoryDropdown.value.toLowerCase(), searchInput.value.toLowerCase());
    });

    function filterData(category, query) {
        const rows = document.querySelectorAll("table tbody tr");
        const indexMap = {"name": 1, "join_year": 3, "leave_year": 4};

        rows.forEach(row => {
            const dataCell = row.cells[indexMap[category]];
            row.style.display = dataCell && dataCell.textContent.toLowerCase().includes(query) ? "" : "none";
        });
    }

    // Modal functionality
    const modal = document.getElementById('alumniModal');
    const closeModalButton = document.getElementById('closeModal');
    const alumniDetails = document.getElementById('alumniDetails');
    const modalContainer = modal.querySelector('div.relative');

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        modalContainer.classList.add('-translate-y-full', 'opacity-0');
    });

    window.openModal = (id) => {
        fetch(`/admin/alumni/${id}`)
            .then(response => response.json())
            .then(data => {
                alumniDetails.innerHTML = `
                    <strong>Name:</strong> ${data.first_name} ${data.last_name}<br>
                    <strong>Email:</strong> ${data.email}<br>
                    <strong>Join Year:</strong> ${data.join_year}<br>
                    <strong>Leave Year:</strong> ${data.leave_year}<br>
                    <strong>Current Job:</strong> ${data.current_job}<br>
                    <strong>Current Company:</strong> ${data.current_company}<br>
                    <strong>Status:</strong> ${data.status}
                `;
                modal.classList.remove('hidden');
                modalContainer.classList.remove('-translate-y-full', 'opacity-0');
            })
            .catch(error => console.error('Error:', error));
    };
    window.verifyAlumni = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to verify this alumni.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/verify/${id}`)
                    .then(response => {
                        if (response.ok) {
                            Swal.fire(
                                'Verified!',
                                'The alumni has been verified.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error verifying the alumni.',
                                'error'
                            );
                        }
                    })
                    .catch(error => Swal.fire(
                        'Error!',
                        'There was an error verifying the alumni.',
                        'error'
                    ));
            }
        });
    };
});
</script>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
}

h1.text-center {
    font-weight: bold;
    color: #343a40;
}

.bg-white {
    background-color: #ffffff;
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

.overflow-x-auto {
    overflow-x: auto;
}

.label-category,
    .label-search {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .block {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .block:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    select, input {
        padding: 0.5rem 0.75rem;
    }

    select:focus, input:focus {
        outline: none;
    }

.btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary {
    background-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-warning {
    color: #000;
}

.btn-danger {
    color: #dc3545;
}

.status-verified {
    color: #28a745;
    font-weight: bold;
}

#alumniModal .relative {
    transition: transform 0.3s ease, opacity 0.3s ease;
    max-width: 500px;
}

#alumniModal .text-center {
    padding: 20px;
}

#alumniModal .text-center h3 {
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 10px;
}

#alumniModal .text-center .text-sm {
    margin-top: 10px;
    line-height: 1.5;
}

#alumniModal .text-center button {
    margin-top: 20px;
}
</style>
