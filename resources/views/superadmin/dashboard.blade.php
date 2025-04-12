@extends('layouts.superadminlayout')

@section('title', 'Superadmin Dashboard')

@section('content')
    <div class="flex-1 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 p-8 rounded-xl shadow-lg" style="width: 100%; min-height: 100vh; overflow-y: auto;">
        <!-- Header -->
        <div class="mb-8 p-6 rounded-lg bg-white shadow-md flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Data Analytics Overview</h1>
            <div class="flex items-center space-x-4">
                <!-- Export Report Button -->
                <button id="exportReportBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-download mr-2"></i>Export Report
                </button>
                <!-- Refresh Data Button -->
                <button id="refreshDataBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh Data
                </button>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Visitor Growth Chart -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Visitor Growth Rate</h4>
                <canvas id="visitorGrowthChart" class="w-full h-64"></canvas>
            </div>

            <!-- Participation Trend Chart -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Participation Trend</h4>
                <canvas id="participationTrendChart" class="w-full h-64"></canvas>
            </div>

            <!-- Visitor Profile Chart -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Visitor Profile</h4>
                <canvas id="visitorProfileChart" class="w-full h-64"></canvas>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <!-- Summary of Admins and Users -->
            <div class="col-span-2 bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Summary of Admins and Users</h2>
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 font-semibold">Role</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-semibold">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-2 border-b text-gray-700">Admins</td>
                            <td class="px-4 py-2 border-b text-gray-700">{{ $adminCount }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-2 border-b text-gray-700">Users</td>
                            <td class="px-4 py-2 border-b text-gray-700">{{ $userCount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- User Logs -->
            <div class="col-span-3 bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-gray-800 mb-4">User Logs</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold">User</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold">Action</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold">Date</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold">IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $log->users_id }}</td>
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $log->action }}</td>
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $log->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $log->ip_address }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 border-b text-center text-gray-700">No logs found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Chart Variables
        let visitorGrowthChart, participationTrendChart, visitorProfileChart;

        // Function to Initialize Charts
        function initializeCharts(visitorGrowthData, participationData, visitorProfileData) {
            // Visitor Growth Chart
            const visitorGrowthCtx = document.getElementById('visitorGrowthChart').getContext('2d');
            visitorGrowthChart = new Chart(visitorGrowthCtx, {
                type: 'bar',
                data: {
                    labels: visitorGrowthData.map(d => d.month),
                    datasets: [{
                        label: 'Visitor Growth',
                        data: visitorGrowthData.map(d => d.count),
                        backgroundColor: 'rgba(79, 70, 229, 0.6)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Participation Trend Chart
            const participationTrendCtx = document.getElementById('participationTrendChart').getContext('2d');
            participationTrendChart = new Chart(participationTrendCtx, {
                type: 'line',
                data: {
                    labels: participationData.map(d => d.month),
                    datasets: [{
                        label: 'Event Participation',
                        data: participationData.map(d => d.count),
                        backgroundColor: 'rgba(16, 185, 129, 0.6)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Visitor Profile Chart
            const visitorProfileCtx = document.getElementById('visitorProfileChart').getContext('2d');
            visitorProfileChart = new Chart(visitorProfileCtx, {
                type: 'pie',
                data: {
                    labels: visitorProfileData.map(d => d.gender),
                    datasets: [{
                        label: 'Visitor Profile',
                        data: visitorProfileData.map(d => d.count),
                        backgroundColor: ['rgba(236, 72, 153, 0.6)', 'rgba(99, 102, 241, 0.6)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Initialize Charts with Initial Data
        initializeCharts(
            @json($visitorGrowthData),
            @json($participationData),
            @json($visitorProfileData)
        );

        // Export Report Button Functionality
        document.getElementById('exportReportBtn').addEventListener('click', function () {
            window.location.href = "{{ route('superadmin.exportReport') }}";
        });

        // Refresh Data Button Functionality (AJAX)
        document.getElementById('refreshDataBtn').addEventListener('click', function () {
            fetch("{{ route('superadmin.refreshData') }}")
                .then(response => response.json())
                .then(data => {
                    // Update Visitor Growth Chart
                    visitorGrowthChart.data.labels = data.visitorGrowthData.map(d => d.month);
                    visitorGrowthChart.data.datasets[0].data = data.visitorGrowthData.map(d => d.count);
                    visitorGrowthChart.update();

                    // Update Participation Trend Chart
                    participationTrendChart.data.labels = data.participationData.map(d => d.month);
                    participationTrendChart.data.datasets[0].data = data.participationData.map(d => d.count);
                    participationTrendChart.update();

                    // Update Visitor Profile Chart
                    visitorProfileChart.data.labels = data.visitorProfileData.map(d => d.gender);
                    visitorProfileChart.data.datasets[0].data = data.visitorProfileData.map(d => d.count);
                    visitorProfileChart.update();
                })
                .catch(error => console.error('Error refreshing data:', error));
        });
    </script>
@endsection