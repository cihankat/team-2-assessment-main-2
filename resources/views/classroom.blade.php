@extends('components.layouts.user')

@section('title', 'Classroom')

@section('content')
<div class="container mx-auto" style="width: 70%;">
    <h1 class="text-3xl font-semibold mb-8">{{$classroom->name }}</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Voornaam
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        voegsel</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Achternaam</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($classroom->users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{$user->firstname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$user->prefix }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$user->lastname }}</td>

                            </tr>
                            @endforeach
                        </tbody>
        </table>
    </div>
</div>
@endsection
