@extends('admin.layouts.layout')
@vite('resources/css/app.css')

@section('title_admin')
    ConnectingNotes | Admin
@endsection

@section('admin_layout')

        <style>
            /* Optional: Improve page break behavior */
            #report-container {
                width: 100%;
            }

            .page-break {
                page-break-before: always;
            }

            canvas {
                max-width: 100% !important;
                height: auto !important;
            }
        </style>


                        <!-- Header -->

                        <div class="mb-8">
                            <h1 class="text-3xl font-semibold text-black dark:text-white">Dashboard Overview</h1>
                            <p class="text-black-500 dark:text-black-400 mt-1">Welcome back, Administrator</p>

                            <!-- MOVE BUTTON HERE -->
                            <div class="mt-4 flex justify-end">
                                <button onclick="downloadPDF()"
                                    class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Download All Reports as PDF
                                </button>
                            </div>
                        </div>


                        <!-- Report Container -->
                        <div id="report-container" class="px-6 py-4">

                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin') }}" class="mb-6 flex flex-col gap-4 items-end">
                                <div>
                                    <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                                    <select id="month" name="month" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                        <option value="">All</option>
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                                    <select id="year" name="year" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                        <option value="">All</option>
                                        @for($y = date('Y'); $y >= 2020; $y--)
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
                                </div>
                            </form>

                            <!-- Bar Chart -->
                            <div class="mt-8">
                                <canvas id="userStatsBarChart" width="400" height="200"></canvas>
                            </div>

                            <!-- Overview Chart -->
                            <div class="mt-8 bg-white p-6 rounded shadow">
                                <h2 class="text-xl font-bold mb-4">Season Overview</h2>
                                <canvas id="overviewChart" height="100"></canvas>
                            </div>

                            <!-- Doughnut Chart -->
                            <div class="mt-8">
                                <canvas id="continuityChart" width="400" height="200"></canvas>
                            </div>

                        </div>

                        <!-- Scripts -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

                        <script>
                            function downloadPDF() {
                                const element = document.getElementById('report-container');
                                const opt = {
                                    margin: [0.5, 0.5, 0.5, 0.5], // top, left, bottom, right
                                    filename: 'all_reports.pdf',
                                    image: { type: 'jpeg', quality: 0.98 },
                                    html2canvas: {
                                        scale: 2,
                                        scrollY: 0,
                                        scrollX: 0,
                                        windowWidth: document.body.scrollWidth,
                                        windowHeight: document.body.scrollHeight
                                    },
                                    jsPDF: {
                                        unit: 'in',
                                        format: 'letter',
                                        orientation: 'portrait'
                                    },
                                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                                };
                                html2pdf().set(opt).from(element).save();
                            }
                        </script>


                        <!-- Chart Scripts -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // User stats
                                const userStatsData = {!! json_encode([
        'users' => $totalUsers ?? 0,
        'admins' => $totalAdmins ?? 0,
        'mentors' => $totalSellers ?? 0,
        'customers' => $totalCustomers ?? 0
    ]) !!};

                                // Bar Chart
                                const barCtx = document.getElementById('userStatsBarChart').getContext('2d');
                                new Chart(barCtx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Users', 'Admins', 'Mentors', 'Students'],
                                        datasets: [{
                                            label: 'User Stats',
                                            data: [
                                                userStatsData.users,
                                                userStatsData.admins,
                                                userStatsData.mentors,
                                                userStatsData.customers
                                            ],
                                            backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1'],
                                            borderColor: ['#FFFFFF'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { position: 'top' },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                                    }
                                                }
                                            }
                                        },
                                        scales: {
                                            y: { beginAtZero: true }
                                        }
                                    }
                                });

                                // Doughnut Chart
                                const studentContinuityData = {!! json_encode([
        'continuing' => $continuingCount,
        'nonContinuing' => $nonContinuingCount,
    ]) !!};

                                const continuityCtx = document.getElementById('continuityChart').getContext('2d');
                                new Chart(continuityCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Continuing Students', 'Non-Continuing Students'],
                                        datasets: [{
                                            data: [
                                                studentContinuityData.continuing,
                                                studentContinuityData.nonContinuing
                                            ],
                                            backgroundColor: ['#28a745', '#dc3545'],
                                            borderColor: ['#ffffff'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { position: 'top' },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });

                                // Overview Chart
                                const totalSessions = {{ $totalSessions }};
                                const totalStudents = {{ $totalStudents }};

                                const overviewCtx = document.getElementById('overviewChart').getContext('2d');
                                new Chart(overviewCtx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Total Sessions', 'Total Students'],
                                        datasets: [{
                                            label: 'Overview',
                                            data: [totalSessions, totalStudents],
                                            backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                                            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                ticks: { precision: 0 }
                                            }
                                        },
                                        plugins: {
                                            legend: { display: false },
                                            title: { display: true, text: 'Total Sessions vs Students Enrolled' }
                                        }
                                    }
                                });
                            });
                        </script>

@endsection
