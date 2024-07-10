@extends('components.layouts.user')

@section('title', 'Bewerk Assessment')
@section('content')
    <div class="container mx-auto" style="width: 80%;">
        <h1 class="text-3xl font-semibold mb-8">Bewerk Assessment</h1>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
            <form action="{{ route('assessment.update', $assessment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                    <input type="text" name="title" id="title" value="{{ $assessment->title }}" class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Bescrijving</label>
                    <textarea name="description" id="description" class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">{{ $assessment->description }}</textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Update</button>
            </form>
            <form action="{{ route('assessment.destroy', $assessment->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-700" onclick="return confirm('Weet je zeker dat je dit assessment wilt verwijderen?')">Verwijder</button>
            </form>
        </div>
    </div>
@endsection
