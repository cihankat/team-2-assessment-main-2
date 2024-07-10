@extends('components.layouts.admin')

@section('title', 'Users')

@section('content')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="mb-4">
            <h2 class="text-2xl font-semibold leading-tight">Gebruikers Management</h2>
        </div>

        <div class="flex justify-between items-center">
            <div class="text-left">
                <form action="{{ route('admin.users') }}" method="GET" class="flex items-center">
                    <input type="text" name="query" placeholder="Zoeken..."
                           class="border border-gray-300 rounded px-4 py-2 mr-2"
                           value="{{ request()->input('query') }}">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                        Zoeken
                    </button>
                </form>
            </div>

            @can('add_class')
                <div class="text-right flex space-x-2">
                    <a href="{{ route('admin.users.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                        Gebruiker Toevoegen
                    </a>

                    <!-- CSV Upload Form -->
                    <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                        @csrf
                        <input type="file" name="csv_file" accept=".csv" required class="border border-gray-300 rounded px-2 py-1">
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                            CSV Importeren
                        </button>
                    </form>
                </div>
            @endcan
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

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Voornaam
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tussenvoegsel
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Achternaam
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Geslacht
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Gebruikers Nummer
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acties
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->firstname }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->prefix }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->lastname }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->gender }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->usernumber }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex justify-end items-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-sm bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition ease-in-out duration-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition ease-in-out duration-300" onclick="return confirm('Are you sure you want to delete this user?')">
                                            Verwijder
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Geen gebruikers gevonden.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $users->links() }}
    </div>
</div>

@endsection
