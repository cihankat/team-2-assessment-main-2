@extends('components.layouts.user')

@section('title', 'Checklist Bekijken')
@section('content')
<div class="container mx-auto" style="width: 80%;">
    <h1 class="text-3xl font-semibold mb-8">Checklist Details</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Titel: {{ $checklist->title }}</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500 my-8">Assessment: {{ $checklist->assessment->title}}</p>
        @can('add_userstory')
        <a href="{{ route('checklists.userstories.create', $checklist->id) }}"
            class="bg-green-500 text-white font-bold py-1 px-3 my-8 rounded hover:bg-green-700">Userstory Toevoegen</a>
        @endcan
    </div>
</div>
<form id="userstoriesForm" method="POST" action="{{ route('userstories.save', $checklist->id) }}">
    @csrf
    <div class="container mx-auto" style="width: 80%;">
        <h1 class="text-3xl font-semibold mb-8">Userstories</h1>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            @foreach ($userstories as $userstory)
            <div class="px-4 py-5 sm:px-6">
                <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
                <input type="checkbox" id="userstory_{{ $userstory->id }}" name="userstories[]"
                    value="{{ $userstory->id }}" {{ in_array($userstory->id, $completedUserstories) ? 'checked' : '' }}>
                <label for="userstory_{{ $userstory->id }}">{{ $userstory->description }}</label>
            </div>
            @endforeach

            <button type="submit" name="action" value="save" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">Opslaan</button>
            <button type="submit" name="action" value="send"class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Versturen</button>
        </div>
    </div>
</form>

<script>
    //JavaScript code to handle submission of form
    document.getElementById('userstoriesForm').addEventListener('submit', function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var allChecked = true;
        checkboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
                return;
            }
        });

        if (!allChecked) {
            alert('Controleer alle userstories voordat u deze verzendt.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

@endsection
