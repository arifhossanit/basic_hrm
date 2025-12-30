@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Create Department</h1>

    <form action="{{ route('departments.store') }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-2">
            <label class="block font-medium text-sm mb-1">Name</label>
            <input type="text" name="name" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
@endsection