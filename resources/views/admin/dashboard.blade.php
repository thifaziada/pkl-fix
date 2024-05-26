@extends('admin.layouts.navigation')

@section('content')
<div class="container mx-auto mt-10 px-6">
    <h1 class="text-center mb-8 text-4xl font-extrabold text-gray-900 dark:text-gray-100">Welcome to the Dashboard!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card Content 1 -->
        <div class="max-w-sm p-6 bg-gradient-to-r from-blue-100 to-blue-200 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
            <div class="flex justify-center mb-4">
                <i class="fas fa-user-graduate fa-3x text-blue-600"></i>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $alumniCount }}</h2>
            <p class="text-gray-600 dark:text-gray-400">Total Alumni</p>
        </div>

        <!-- Card Content 2 -->
        <div class="max-w-sm p-6 bg-gradient-to-r from-yellow-100 to-yellow-200 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
            <div class="flex justify-center mb-4">
                <i class="fas fa-question-circle fa-3x text-yellow-600"></i>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $faqCount }}</h2>
            <p class="text-gray-600 dark:text-gray-400">Total FAQs</p>
        </div>

        <!-- Card Content 3 -->
        <div class="max-w-sm p-6 bg-gradient-to-r from-green-100 to-green-200 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
            <div class="flex justify-center mb-4">
                <i class="fas fa-user-friends fa-3x text-green-600"></i>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $referralCount }}</h2>
            <p class="text-gray-600 dark:text-gray-400">Total Referrals</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <!-- Doughnut Chart Container for Alumni Status -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg shadow-lg p-6">
            <h5 class="text-lg font-semibold text-center text-gray-800 dark:text-gray-100 mb-4">Alumni Status</h5>
            <canvas id="alumniDoughnutChart"></canvas>
        </div>

        <!-- Doughnut Chart Container for FAQ Status -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg shadow-lg p-6">
            <h5 class="text-lg font-semibold text-center text-gray-800 dark:text-gray-100 mb-4">FAQ Status</h5>
            <canvas id="faqDoughnutChart"></canvas>
        </div>

        <!-- Doughnut Chart Container for Referral Status -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg shadow-lg p-6">
            <h5 class="text-lg font-semibold text-center text-gray-800 dark:text-gray-100 mb-4">Referral Status</h5>
            <canvas id="referralDoughnutChart"></canvas>
        </div>
    </div>
</div>
@endsection

<!-- Load Chart.js and jQuery from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var alumniChart = document.getElementById('alumniDoughnutChart').getContext('2d');
    var faqChart = document.getElementById('faqDoughnutChart').getContext('2d');
    var referralChart = document.getElementById('referralDoughnutChart').getContext('2d');

    new Chart(alumniChart, {
        type: 'doughnut',
        data: {
            labels: ['Verified', 'Not Verified'],
            datasets: [{
                data: [{{ $alumniVerifiedCount }}, {{ $alumniNotVerifiedCount }}],
                backgroundColor: ['#1E90FF', '#FF6347'],
                hoverOffset: 4,
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4B5563',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: {
                        size: 16
                    },
                    bodyFont: {
                        size: 14
                    },
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    new Chart(faqChart, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [{{ $faqPendingCount }}, {{ $faqApprovedCount }}, {{ $faqRejectedCount }}],
                backgroundColor: ['#FFD700', '#4CAF50', '#FF4500'],
                hoverOffset: 4,
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4B5563',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: {
                        size: 16
                    },
                    bodyFont: {
                        size: 14
                    },
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    new Chart(referralChart, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Accepted', 'Rejected'],
            datasets: [{
                data: [{{ $referralPendingCount }}, {{ $referralAcceptedCount }}, {{ $referralRejectedCount }}],
                backgroundColor: ['#FFD700', '#4CAF50', '#FF4500'],
                hoverOffset: 4,
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4B5563',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: {
                        size: 16
                    },
                    bodyFont: {
                        size: 14
                    },
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});
</script>
