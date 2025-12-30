@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <h1 class="text-2xl font-bold mb-2 sm:mb-0">Employees</h1>
        <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Employee</a>
    </div>

    <div class="mb-4">
        <label>Filter by Department:</label>
        <select id="filter-department" class="border rounded px-2 py-1">
            <option value="">-- All --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        @if($employees->isEmpty())
            <div class="p-4 text-gray-600">No employees found.</div>
        @else
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Department</th>
                    <th class="px-4 py-2 text-left">Skills</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="employees-body">
                @foreach($employees as $employee)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td class="px-4 py-2">{{ $employee->email }}</td>
                        <td class="px-4 py-2">{{ optional($employee->department)->name }}</td>
                        <td class="px-4 py-2">{{ $employee->skills->pluck('name')->join(', ') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('employees.show', $employee) }}" class="text-blue-500">View</a>
                            <a href="{{ route('employees.edit', $employee) }}" class="ml-2 text-green-500">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$(function(){
    $('#filter-department').change(function(){
        var department_id = $(this).val();
        $.get("{{ route('employees.index') }}", { department_id: department_id }, function(data){
            // If server returns JSON (AJAX), data will be an array of employees
            if (Array.isArray(data)) {
                var rows = '';
                data.forEach(function(emp){
                    rows += '<tr class="border-t">' +
                        '<td class="px-4 py-2">'+ emp.first_name + ' ' + emp.last_name +'</td>'+
                        '<td class="px-4 py-2">'+ emp.email +'</td>'+
                        '<td class="px-4 py-2">'+ (emp.department ? emp.department.name : '') +'</td>'+
                        '<td class="px-4 py-2">'+ (emp.skills ? emp.skills.map(s=>s.name).join(', ') : '') +'</td>'+
                        '<td class="px-4 py-2">' +
                        '<a href="/employees/'+emp.id+'" class="text-blue-500">View</a>'+
                        '<a href="/employees/'+emp.id+'/edit" class="ml-2 text-green-500">Edit</a>'+
                        '</td>'+
                        '</tr>';
                });
                $('#employees-body').html(rows);
            }
        });
    });
});
</script>
@endsection