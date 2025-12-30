@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Skills</h1>
        <a href="{{ route('skills.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Skill</a>
    </div>

    <div class="bg-white rounded shadow p-4">
        <ul class="divide-y">
            @foreach($skills as $s)
                <li class="py-2 flex justify-between items-center">
                    {{ $s->name }}
                    <form action="{{ route('skills.destroy', $s) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection