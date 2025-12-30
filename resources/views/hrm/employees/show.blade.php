@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Employee details</h1>

    <div class="mb-2">Name: <strong>{{ $employee->first_name }} {{ $employee->last_name }}</strong></div>
    <div class="mb-2">Email: <strong>{{ $employee->email }}</strong></div>
    <div class="mb-2">Department: <strong>{{ optional($employee->department)->name }}</strong></div>
    <div class="mb-2">Skills: <strong>{{ $employee->skills->pluck('name')->join(', ') }}</strong></div>

    <a href="{{ route('employees.edit', $employee) }}" class="bg-green-500 text-white px-4 py-2 rounded">Edit</a>
    <a href="{{ route('employees.index') }}" class="ml-2">Back</a>
</div>
@endsection