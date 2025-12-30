@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Employee</h1>

    @include('hrm.employees._form', ['action' => route('employees.update', $employee), 'method' => 'PUT'])
</div>
@endsection