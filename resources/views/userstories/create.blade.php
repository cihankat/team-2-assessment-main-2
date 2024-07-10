@extends('components.layouts.user')

@section('title', 'Userstory Toevoegen')

@section('content')
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Userstory Toevoegen</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
        <form action="{{ route('userstories.store', $checklist->id) }}" method="POST">
            @csrf
            <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                <input type="text" name="description" id="description"
                    class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Userstory Toevoegen</button>
        </form>
    </div>
</div>
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Userstories</h1>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    @foreach ($userstories as $userstory)
    <div class="px-4 py-5 sm:px-6">
        <input type="checkbox" id="userstory_{{ $userstory->id }}" name="userstories[]" value="{{ $userstory->id }}">
        <label for="userstory_{{ $userstory->id }}">{{ $userstory->description }}</label>
    </div>
    @endforeach
</div>
</div>

@endsection
