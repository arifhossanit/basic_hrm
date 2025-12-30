@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Create Employee</h1>

    @include('hrm.employees._form', ['action' => route('employees.store')])
</div>
@endsection