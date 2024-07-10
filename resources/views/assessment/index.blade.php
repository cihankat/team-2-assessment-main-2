@extends('components.layouts.user')

@section('title', 'Assessment')

@section('content')
    <div class="container mx-auto" style="width: 70%;">
        <h1 class="text-3xl font-semibold mb-8">Assessments</h1>
        @can('add_assessment')
            <a href="{{ ' /assessment/create' }}"
                class="bg-blue-500 text-white font-bold py-2 px-4 rounded mb-4 inline-block hover:bg-blue-700">Nieuw
                assessment</a>
        @endcan
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titel
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Beschrijving</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Klas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acties
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($assessments as $assessment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $assessment->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap ">{{ $assessment->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <a href="{{ route('classroom.show',$assessment->classroom->id) }}">{{$assessment->classroom->name }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm font-medium">
                            <div class="flex justify-start space-x-2">
                                    <a href="{{ route('assessment.show', $assessment->id) }}"
                                        class="bg-blue-500 text-white font-bold py-1 px-3 rounded hover:bg-blue-700">Bekijk</a>
                                @can('edit_assessment')
                                    <a href="{{ route('assessment.edit', $assessment->id) }}"
                                        class="bg-yellow-500 text-white font-bold py-1 px-3 rounded hover:bg-yellow-700">Bewerken</a>
                                @endcan
                                @can('delete_assessment')
                                    <form action="{{ route('assessment.destroy', $assessment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white font-bold py-1 px-3 rounded hover:bg-red-700"
                                            onclick="return confirm('Are you sure you want to delete this assessment?')">Verwijder</button>
                                    </form>
                                @endcan
                                @can('add_checklist')
                                    <a href="{{ route('assessment.checklists.create', $assessment->id) }}"
                                        class="bg-green-500 text-white font-bold py-1 px-3 rounded hover:bg-green-700">Checklist Toevoegen</a>
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
