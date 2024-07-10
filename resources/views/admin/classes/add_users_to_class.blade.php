@extends('components.layouts.admin')

@section('title', 'Klassen')

@section('content')

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold leading-tight">Gebruikers aan klas toevoegen: {{ $classroom->name }}</h2>
            </div>

            <div class="flex justify-between items-center">
                <div class="text-left">
                    <form action="{{ route('admin.classes.adduser', ['classroomID' => $classroom->id]) }}" method="GET"
                          class="flex items-center">
                        <input type="text" name="query" placeholder="Zoeken..."
                               class="border border-gray-300 rounded px-4 py-2 mr-2" value="{{ request()->input('query') }}">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                            Zoeken
                        </button>
                    </form>
                </div>
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
                                Voornaam
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Achternaam
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Rol
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acties
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    #{{ $user->id }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->firstname }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->lastname }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->rank }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex justify-end">
                                        @if($user->classrooms->contains($classroom->id))
                                            <form
                                                action="{{ route('admin.classes.adduser.delete', ['userID' => $user->id, 'classroomID' => $classroom->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                                                    Verwijder van klas
                                                </button>
                                            </form>
                                        @else
                                            <form
                                                action="{{ route('admin.classes.adduser.post', ['userID' => $user->id, 'classroomID' => $classroom->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
                                                    Toevoegen aan klas
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection
