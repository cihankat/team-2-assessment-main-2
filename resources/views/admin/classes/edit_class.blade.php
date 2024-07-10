@extends('components.layouts.admin')

@section('title', 'Bewerk Klass')

@section('content')
    <div class="container mx-auto px-4 sm:px-8 max-w-3xl">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Bewerk Klas</h2>
            </div>
            <div class="mt-8">
                <form action="{{ route('admin.classes.update', ['id' => $class->id]) }}" method="POST" class="max-w-lg">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Klas Naam:</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border @error('name') border-red-500 @enderror border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('name', $class->name) }}" required>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update Klas
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
