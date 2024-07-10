@extends('components.layouts.user')

@section('title', 'Afspraak maken')

@section('content')
<div class="container mx-auto px-20" style="width: 70%;">
    <h1 class="text-3xl font-semibold mb-8">Maak een nieuwe afspraak</h1>
    <form action="/appointment/store" method="POST">
        @csrf
        <div class="mb-4">
            <input type="hidden" name="student_id" id="student_id">
            <div class="col-md-6">
                <label for="name"class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="col-md-6">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start tijd</label>
                <input type="datetime-local" name="start_time" id="start_time"
                class=" mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('start_time') is-invalid @enderror" name="start_time"
                    value="{{ old('start_time') }}" required autocomplete="start_time" autofocus>
                @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Eind Tijd</label>
                <input type="datetime-local" name="finish_time" id="finish_time"
                    class=" mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('finish_time') is-invalid @enderror"
                    name="finish_time" value="{{ old('finish_time') }}" required autocomplete="finish_time" autofocus>
                @error('finish_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
            <label for="comments" class="block text-sm font-medium text-gray-700">Opmerking</label>
                <input id="comments" type="" class=" mt-1 p-2 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md form-control @error('comments') is-invalid @enderror" name="comments"
                    value="{{ old('comments') }}" required autocomplete="comments" autofocus>
                @error('comments')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Aanmaken</button>
    </form>
</div>
@endsection
