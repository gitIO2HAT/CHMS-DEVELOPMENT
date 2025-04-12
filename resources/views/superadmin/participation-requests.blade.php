@extends('layouts.superadminlayout')

@section('content')
<div class="container mx-auto p-8 flex-1 bg-gradient-to-r rounded-xl shadow-lg" style="width: 100%; min-height: 100vh; overflow-y: auto; ">
    <!-- Page Header -->
    <div class="mb-8 p-6 rounded-lg bg-white shadow-md flex items-center justify-between">
        <h1 class="text-3xl font-bold text-purple-600">Participation Requests</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Participation Requests Table -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        @if($requests->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-8">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 text-lg">No participation requests at the moment.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Event</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($requests as $request)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <!-- User -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $request->user->name }}</div>
                                            <div class="text-gray-500">{{ $request->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Event -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-medium text-gray-900">{{ $request->event->name }}</div>
                                    <div class="text-gray-500">{{ $request->event->date->format('M d, Y') }}</div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-sm">
                                    @if($request->status == 'pending')
                                        <span class="px-3 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded-full">Pending</span>
                                    @elseif($request->status == 'approved')
                                        <span class="px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">Approved</span>
                                    @else
                                        <span class="px-3 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">Rejected</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-sm">
                                    @if($request->status == 'pending')
                                        <div class="flex space-x-2">
                                            <form method="POST" action="{{ route('superadmin.participation-requests.approve', $request->id) }}">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                                                    <i class="fas fa-check mr-2"></i>Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('superadmin.participation-requests.reject', $request->id) }}">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                                                    <i class="fas fa-times mr-2"></i>Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Action completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection