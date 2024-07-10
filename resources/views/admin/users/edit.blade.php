@extends('components.layouts.admin')

@section('title', 'Classes')

@section('content')

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Gebruiker Bewerken</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded text-green-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2">Voornaam:</label>
                    <input type="text" id="firstname" name="firstname" value="{{ $user->firstname }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="prefix" class="block text-gray-700 text-sm font-bold mb-2">Tussenvoegsel:</label>
                    <input type="text" id="prefix" name="prefix" value="{{ $user->prefix }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring focus:ring-blue-200 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Achternaam:</label>
                    <input type="text" id="lastname" name="lastname" value="{{ $user->lastname }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Geslacht:</label>
                    <select id="gender" name="gender" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500">
                        <option value="Man" {{ $user->gender == 'Man' ? 'selected' : '' }}>Man</option>
                        <option value="Vrouw" {{ $user->gender == 'Woman' ? 'selected' : '' }}>Vrouw</option>
                        <option value="Anders" {{ $user->gender == 'Other' ? 'selected' : '' }}>Anders</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="usernumber" class="block text-gray-700 text-sm font-bold mb-2">Gebruikers Nummer:</label>
                    <input type="text" id="usernumber" name="usernumber" value="{{ $user->usernumber }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Rollen:</label>
                    <select name="roles[]" id="roles" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Here you can add the password change fields if needed --}}

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="submit">
                        Bewerk Gebruiker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
