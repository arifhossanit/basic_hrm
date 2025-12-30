<form action="{{ $action }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow">
    @csrf
    @if(in_array($method ?? 'POST', ['PUT', 'PATCH']))
        @method($method)
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label class="block font-medium text-sm mb-1">First name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" class="border rounded px-3 py-2 w-full" required>
    </div>

    <div>
        <label class="block font-medium text-sm mb-1">Last name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" class="border rounded px-3 py-2 w-full" required>
    </div>

    <div>
        <label class="block font-medium text-sm mb-1">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="border rounded px-3 py-2 w-full" required>
        <div id="email-feedback" class="text-sm mt-1"></div>
    </div>

    <div>
        <label class="block font-medium text-sm mb-1">Department</label>
        <select name="department_id" class="border rounded px-3 py-2 w-full" required>
            <option value="">-- Select --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" {{ isset($employee) && $employee->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium text-sm mb-1">Skills</label>
        <select id="skills-select" name="skills[]" multiple class="border rounded px-3 py-2 w-full">
            @foreach($skills as $skill)
                <option value="{{ $skill->id }}" {{ isset($employee) && $employee->skills->pluck('id')->contains($skill->id) ? 'selected' : '' }}>{{ $skill->name }}</option>
            @endforeach
        </select>
        <div class="mt-2">
            <button type="button" id="add-skill" class="bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded">+ Add Skill</button>
        </div>
    </div>

    <div class="mt-4">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$(function(){
    // Setup CSRF for AJAX
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Real-time email uniqueness check
    $('#email').on('blur', function(){
        var email = $(this).val();
        if(!email) return;
        $.get("{{ route('employees.checkEmail') }}", { email: email }, function(resp){
            if (resp.exists) {
                $('#email-feedback').text('Email already in use').addClass('text-red-600').removeClass('text-green-600');
            } else {
                $('#email-feedback').text('Email available').addClass('text-green-600').removeClass('text-red-600');
            }
        });
    });

    // Add new skill via prompt
    $('#add-skill').click(function(){
        var name = prompt('Skill name');
        if(!name) return;
        $.post("{{ route('skills.store') }}", { name: name }, function(skill){
            // append to select
            var option = $('<option>').val(skill.id).text(skill.name).prop('selected', true);
            $('#skills-select').append(option);
        }).fail(function(xhr){
            alert('Unable to add skill: '+ (xhr.responseJSON?.message || 'validation error'));
        });
    });
});
</script>