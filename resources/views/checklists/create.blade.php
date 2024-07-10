@extends('components.layouts.user')

@section('title', 'Checklist Toevoegen')

@section('content')
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Checklist Toevoegen</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
        <form action="{{ route('checklists.store', $assessment->id) }}" method="POST">
            @csrf
            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="title" id="title"
                    class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Checklist Toevoegen</button>
        </form>
    </div>
</div>
@endsection
