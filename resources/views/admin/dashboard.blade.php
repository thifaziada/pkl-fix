@extends('admin.layouts.navigation')

@section('content')
<div class="container mx-auto my-10 px-6">
@php
    $user = Auth::user();
@endphp
<h1 class="text-left mb-12 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Welcome to the Dashboard {{$user->name}}!!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card Content 1 -->
        <div class="p-6 transition transform hover:scale-105 hover:shadow-xl rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 shadow-lg text-white">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-user-graduate fa-3x"></i>
            </div>
            <h2 class="text-3xl font-semibold">{{ $alumniCount }}</h2>
            <p class="text-opacity-90">Total Alumni</p>
        </div>

        <!-- Card Content 2 -->
        <div class="p-6 transition transform hover:scale-105 hover:shadow-xl rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-600 shadow-lg text-white">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-question-circle fa-3x"></i>
            </div>
            <h2 class="text-3xl font-semibold">{{ $faqCount }}</h2>
            <p class="text-opacity-90">Total FAQs</p>
        </div>

        <!-- Card Content 3 -->
        <div class="p-6 transition transform hover:scale-105 hover:shadow-xl rounded-lg bg-gradient-to-r from-green-400 to-green-600 shadow-lg text-white">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-user-friends fa-3x"></i>
            </div>
            <h2 class="text-3xl font-semibold">{{ $referralCount }}</h2>
            <p class="text-opacity-90">Total Referrals</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <!-- Doughnut Chart Container -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <h5 class="text-lg font-semibold text-center text-gray-900 dark:text-white mb-4">Alumni Status</h5>
            <canvas id="alumniDoughnutChart"></canvas>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <h5 class="text-lg font-semibold text-center text-gray-900 dark:text-white mb-4">FAQ Status</h5>
            <canvas id="faqDoughnutChart"></canvas>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <h5 class="text-lg font-semibold text-center text-gray-900 dark:text-white mb-4">Referral Status</h5>
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
    const doughnutChartOptions = {
        type: 'doughnut',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: 'text-gray-800',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'bg-gray-800',
                    titleFont: {
                        size: 16
                    },
                    bodyFont: {
                        size: 14
                    },
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    const chartData = {
        alumni: {
            labels: ['Verified', 'Not Verified'],
            data: [{{ $alumniVerifiedCount }}, {{ $alumniNotVerifiedCount }}],
            backgroundColor: ['#6366F1', '#EF4444'],
        },
        faq: {
            labels: ['Pending', 'Approved', 'Rejected'],
            data: [{{ $faqPendingCount }}, {{ $faqApprovedCount }}, {{ $faqRejectedCount }}],
            backgroundColor: ['#FCD34D', '#10B981', '#F87171'],
        },
        referral: {
            labels: ['Pending', 'Accepted', 'Rejected'],
            data: [{{ $referralPendingCount }}, {{ $referralAcceptedCount }}, {{ $referralRejectedCount }}],
            backgroundColor: ['#EAB308', '#22C55E', '#EF4444'],
        }
    };

    // Initialize charts
    Object.keys(chartData).forEach(key => {
        new Chart(document.getElementById(`${key}DoughnutChart`).getContext('2d'), {
            ...doughnutChartOptions,
            data: {
                labels: chartData[key].labels,
                datasets: [{
                    data: chartData[key].data,
                    backgroundColor: chartData[key].backgroundColor,
                    hoverOffset: 4,
                    borderWidth: 1,
                    borderColor: '#ffffff'
                }]
            }
        });
    });
});
</script>
