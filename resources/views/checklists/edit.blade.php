@extends('components.layouts.user')

@section('title', 'Checklist Bewerken')

@section('content')
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Checklist Bewerken</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
        <form action="{{ route('checklists.update', $checklist->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titel/label>
                <input type="text" name="title" id="title" value="{{ $checklist->title }}"
                    class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Checklist Bewerken</button>
        </form>
    </div>
</div>
@endsection
