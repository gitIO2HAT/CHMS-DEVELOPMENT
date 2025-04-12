@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Events</h1>

    <div class="space-y-6 scrollable">
        @if($events->isEmpty())
            <p class="text-center text-gray-500">No events available.</p>
        @else
            @foreach($events as $event)
                @include('admin.event-card', ['event' => $event]) <!-- Include individual event card -->
            @endforeach
        @endif
    </div>
</div>
@endsection
