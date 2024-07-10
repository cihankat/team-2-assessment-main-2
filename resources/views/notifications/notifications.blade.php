@extends('components.layouts.user')

@section('title', 'Meldingen')

@section('content')
    <div class="mx-auto mt-8 w-3/4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('notifications.markAllAsRead') }}"
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Markeer alles als
                gelezen</a>
        </div>
    </div>

    @foreach($notifications as $notification)
        <div class="mx-auto mt-4 p-6 bg-white rounded-lg shadow-md w-3/4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $notification->title }}</h2>
            <p class="text-lg text-gray-700 mb-4">
                {{ $notification->message }}
            </p>
            <div class="flex justify-end">
                @if($notification->read_at)
                    <a href="{{ route('notifications.markAsUnread', ['id' => $notification->id]) }}"
                       class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2">Markeren als niet
                        gelezen</a>
                @else
                    <a href="{{ route('notifications.markAsRead', ['id' => $notification->id]) }}"
                       class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Markeren als
                        gelezen</a>
                @endif
                <a href="{{ route('notifications.notification', ['id' => $notification->id]) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Bekijk >></a>
            </div>
        </div>
    @endforeach
@endsection
