@extends('components.layouts.user')

@section('title', 'Assessment Maken')

@section('content')
<div class="container mx-auto px-20" style="width: 70%;">
    <h1 class="text-3xl font-semibold mb-8">Maak een nieuw assessment aan</h1>
    <form action="/assessment/store" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
            <div class="col-md-6">
                <input id="title" type="text" class=" mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
            <div class="col-md-6">
            <textarea name="description" id="description"
                class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('description') is-invalid @enderror"
                value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
        </div>
        <div class="mb-4">
            <label for="classroom_id" class="block text-sm font-medium text-gray-700">Klas</label>
            <div class="col-md-6">
            <select name="classroom_id" id="classroom_id" class="mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('classroom_id') is-invalid @enderror"
            value="{{ old('classroom_id') }}" required autocomplete="classroom_id" autofocus>
                @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
            @error('classroom_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Opslaan</button>
    </form>
</div>
@endsection
