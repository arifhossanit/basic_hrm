@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Departments</h1>
        <a href="{{ route('departments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Department</a>
    </div>

    <div class="bg-white rounded shadow p-4">
        <ul class="divide-y">
            @foreach($departments as $d)
                <li class="py-2">{{ $d->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection