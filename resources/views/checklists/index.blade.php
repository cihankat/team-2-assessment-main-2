@extends('components.layouts.user')

@section('title', 'Checklist')
@section('content')
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Checklist</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
       <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Titel
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Assessment
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acties
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($checklists as $checklist)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $checklist->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $checklist->assessment?->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex justify-start space-x-2">
                        <a href="{{ route('checklists.show', $checklist->id) }}"
                            class="bg-blue-500 text-white font-bold py-1 px-3 rounded hover:bg-blue-700">Bekijken</a>
                        @can('edit_checklist')
                        <a href="{{ route('checklists.edit', $checklist->id) }}"
                            class="bg-yellow-500 text-white font-bold py-1 px-3 rounded hover:bg-yellow-700">Bewerken</a>
                        @endcan
                        @can('delete_checklist')
                        <form action="{{ route('checklists.destroy', $checklist->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-bold py-1 px-3 rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this assessment?')">Verwijderen</button>
                        </form>
                        @endcan
                        @can('add_userstory')
                        <a href="{{ route('checklists.userstories.create', $checklist->id) }}"
                            class="bg-green-500 text-white font-bold py-1 px-3 rounded hover:bg-green-700">Userstory Toevoegen</a>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    @endsection
