@extends('layouts.app') 

@section('content')

<div class="container mt-0">

    <!-- Title Section -->
    <h1 class="text-3xl font-extrabold text-center text-purple-800 mb-4">List of Participants</h1>

    <!-- Scrollable Events Container -->
    <div class="max-h-[500px] gap-6 overflow-y-auto ">
        <!-- Loop through events -->
        @foreach($events as $event)
            <div class="mb-5 p-6 bg-white rounded-lg shadow-md border border-gray-200">
                
                <!-- Event Title -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $event->name }}</h2>

                <!-- Event Date -->
                <p class="text-gray-600 text-sm">Event Date: <span class="font-medium">{{ $event->date->format('F d, Y') }}</span></p>

                <!-- Participants Table -->
                <div class="max-h-96 overflow-y-auto">
                    <table class="min-w-full table-auto border-collapse text-sm">
                        <thead class="bg-purple-600 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">Participant Name</th>
                                <th class="py-2 px-4 text-left">Email</th>
                                <th class="py-2 px-4 text-left">Event Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Check if participants exist -->
                            @if($event->participants->isEmpty())
                                <tr>
                                    <td colspan="3" class="py-2 px-4 text-center text-gray-500">No participants for this event.</td>
                                </tr>
                            @else
                                @foreach($event->participants as $participation)
                                    @if($participation->status == 'approved')
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-2 px-4">{{ $participation->user->name }}</td>
                                            <td class="py-2 px-4">{{ $participation->user->email }}</td>
                                            <td class="py-2 px-4">{{ $event->date->format('F d, Y') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
