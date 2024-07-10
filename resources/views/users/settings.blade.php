@extends('components.layouts.user')

@section('title', 'User Settings')

@section('content')

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Gebruikersinstellingen</h2>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Display User Settings -->

        <!-- Profile Picture Display -->
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2">Profiel afbeelding:</label>
            @if(auth()->user()->profile_picture)
                <div>
                    <!-- Ensure that the correct path is provided for the image src -->
                    <img src="{{ asset('storage/profile_pictures/' . auth()->user()->profile_picture) }}" alt="User Profile Picture" class="h-20 w-20 object-cover rounded-full">
                </div>
            @else
                <div>
                    <p>Geen profielfoto ingesteld.</p>
                </div>
            @endif
        </div>

        <div class="mt-4">
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Voornaam:</label>
                <div class="p-2 bg-gray-100 rounded">{{ auth()->user()->firstname }}</div>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tussenvoegsel:</label>
                <div class="p-2 bg-gray-100 rounded">{{ auth()->user()->prefix }}</div>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Achternaam:</label>
                <div class="p-2 bg-gray-100 rounded">{{ auth()->user()->lastname }}</div>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Geslacht:</label>
                <div class="p-2 bg-gray-100 rounded">{{ auth()->user()->gender }}</div>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <div class="p-2 bg-gray-100 rounded">{{ auth()->user()->email }}</div>
            </div>
        </div>

        <!-- Edit Settings and Logout Buttons -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('user.settings.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Verander gebruikersinstellingen
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Log uit
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
