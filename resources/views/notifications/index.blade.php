@extends('layouts.app')
@section('pageTitle', 'Notifications')
@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6  bg-white rounded shadow p-6 mt-6">

        @if ($notifications->count())
            <div class="flex justify-end mb-4">
                <form method="POST" action="{{ route('notifications.markAllRead') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tout marquer
                        comme lue</button>
                </form>
            </div>
            <ul class="divide-y divide-gray-200">
                @foreach ($notifications as $notification)
                    <li class="py-4 flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $notification->data['title'] ?? 'Notification' }}</span>
                            <div class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                        <form method="POST" action="{{ route('notifications.markRead', $notification->id) }}">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Marquer comme
                                lue</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-center text-gray-500 py-12">
                Aucune nouvelle notification pour le moment.
            </div>
        @endif
    </div>
@endsection
