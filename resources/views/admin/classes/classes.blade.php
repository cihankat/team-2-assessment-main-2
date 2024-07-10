@extends('components.layouts.admin')

@section('title', 'Classes')

@section('content')

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold leading-tight">Klassen</h2>
            </div>

            <div class="flex justify-between items-center">
                <div class="text-left">
                    <form action="{{ route('admin.classes') }}" method="GET" class="flex items-center">
                    <form action="{{ route('admin.classes') }}" method="GET" class="flex items-center">
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
                    <div class="text-right">
                        <a href="{{ route('admin.classes.add') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                            Klas Toevoegen
                        </a>
                    </div>
                @endcan
            </div>


            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Klas
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Gebruikers in klas
                            </th>
                            <th class="px-52 py-3 border-b-2 border-gray-300 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acties
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    #{{ $class->id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $class->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $class->users_count }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex justify-end">
                                        <a href="{{ route('admin.classes.adduser', ['classroomID' => $class->id]) }}"
                                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                                            Gebruikers toevoegen
                                        </a>

                                        <a href="{{ route('admin.classes.edit', ['id' => $class->id]) }}"
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300 ml-2">
                                            Bewerken
                                        </a>

                                        <form action="{{ route('admin.classes.delete', ['id' => $class->id]) }}"
                                              method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300"
                                                    onclick="return confirm('Weet je zeker dat je deze klas wilt verwijdeen?');">
                                                Verwijder
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $classes->links() }}
            </div>
        </div>
    </div>

@endsection
