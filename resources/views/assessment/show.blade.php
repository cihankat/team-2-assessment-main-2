@extends('components.layouts.user')

@section('title', 'Assessment Bekijken')

@section('content')
    <div class="container mx-auto my-4" style="width: 80%;">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
            <h1 class="text-3xl font-semibold text-gray-800">{{ $assessment->title }}</h1>
            <p class="mt-2 text-sm text-gray-500">{{ $assessment->description }}</p>
            <div class="mt-4">
                @can('edit_assessment')
                    <a href="{{ route('assessment.edit', $assessment->id) }}"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Bewerken</a>
                @endcan
                @can('delete_assessment')
                    <form action="{{ route('assessment.destroy', $assessment->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Are you sure you want to delete this assessment?')">Verwijder</button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Checklists</h2>
            @if ($assessment->checklists->isNotEmpty())
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($assessment->checklists as $checklist)
                        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $checklist->title }}</h3>
                            <div class="mt-4">
                                <a href="{{ route('checklists.show', $checklist->id) }}"
                                    class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Bekijk Checklist</a>
                                @can('edit_checklist')
                                    <a href="{{ route('checklists.edit', $checklist->id) }}"
                                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Bewerk
                                        Checklist</a>
                                @endcan
                                @can('delete_checklist')
                                <form action="{{ route('checklists.destroy', $checklist->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure you want to delete this checklist?')">Verwijder</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Geen checklists beschikbaar.</p>
            @endif
        </div>
    </div>
@endsection
