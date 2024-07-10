@extends('components.layouts.user')

@section('title', 'Edit User Settings')

@section('content')

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Verander Gebruikersinstellingen</h2>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-8">
            <!-- Include enctype attribute to enable file uploads -->
            <form action="{{ route('user.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Profile Picture Field -->
                <div class="mb-4">
                    <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Profiel afbeelding:</label>
                    <input type="file" id="profile_picture" name="profile_picture"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- First Name Field -->
                <div class="mb-4">
                    <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2">Voornaam:</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Prefix Field -->
                <div class="mb-4">
                    <label for="prefix" class="block text-gray-700 text-sm font-bold mb-2">Tussenvoegsel:</label>
                    <input type="text" id="prefix" name="prefix" value="{{ old('prefix', auth()->user()->prefix) }}"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Last Name Field -->
                <div class="mb-4">
                    <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Achternaam:</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Gender Field -->
                <div class="mb-4">
                <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Geslacht:</label>
                    <select id="gender" name="gender" required class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="Man" {{ auth()->user()->gender == 'Man' ? 'selected' : '' }}>Man</option>
                        <option value="Vrouw" {{ auth()->user()->gender == 'Vrouw' ? 'selected' : '' }}>Vrouw</option>
                        <option value="Anders" {{ auth()->user()->gender == 'Anders' ? 'selected' : '' }}>Anders</option>
                    </select>
                </div>

                <!-- Update Settings Button -->
                <div class="flex items-center justify-between">
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
