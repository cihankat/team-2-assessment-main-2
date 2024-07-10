@extends('components.layouts.user')

@section('title', $notification->title)

@section('content')
    <div class="mx-auto mt-8 p-6 bg-white rounded-lg shadow-md w-3/4">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $notification->title }}</h2>
        <p class="text-lg text-gray-700 mb-4">
            {{ $notification->message }}
        </p>
        <div class="flex justify-end">
            @if($notification->read_at)
                <a href="{{ route('notifications.markAsUnread', ['id' => $notification->id]) }}"
                   class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2">Markeren als niet
                    bekeken</a>
            @else
                <a href="{{ route('notifications.markAsRead', ['id' => $notification->id]) }}"
                   class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Markeren als
                    bekeken</a>
            @endif
        </div>
    </div>
@endsection
