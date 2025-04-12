@extends('layouts.app')

@section('title', 'Visitor Reports')

@section('content')
    <div id="reports-content" class="flex-1 p-6 bg-white shadow-md rounded-lg transition-all duration-300 ease-in-out">
        <h1 class="text-2xl font-bold mb-4">Visitor Summary Report</h1>
        <!-- Event Selection -->
        <form action="{{ route('admin.reports.generateEventPDF') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="event" class="text-lg font-semibold">Choose Event:</label>
                <select id="event" name="events_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="">-- Select Event --</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Generate Report (PDF)
            </button>
        </form>
        <!-- Visitors Table -->
        @if ($visitors->isEmpty())
            <div class="text-gray-600 text-center">
                <p>No visitors data available to display.</p>
            </div>
        @else
            <table class="table-auto w-full border-collapse border border-gray-200 mt-6 mb-3">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 p-2">Gender</th>
                        <th class="border border-gray-300 p-2">Age Group</th>
                        <th class="border border-gray-300 p-2">Total Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 text-center">{{ $visitor->gender }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $visitor->age_group }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $visitor->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <!-- Export Button -->
        <div class="mb-4 flex space-x-4">
            <!-- Export as CSV Button -->
            <a href="{{ route('admin.reports.export') }}" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Export as CSV
            </a>
        </div>
    </div>

    <script>
        // Sidebar positioning adjustments (optional)
        const sidebar = document.getElementById('sidebar');
        const reportsContent = document.getElementById('reports-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        function adjustReportsPosition() {
            if (sidebar.classList.contains('collapsed')) {
                reportsContent.style.marginLeft = "0.3%";
            } else {
                reportsContent.style.marginLeft = "0.3%";
            }
        }

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adjustReportsPosition();
        });

        adjustReportsPosition();
    </script>
@endsection
