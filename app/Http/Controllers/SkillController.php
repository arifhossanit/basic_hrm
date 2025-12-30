<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $skills = Skill::all();
        return view('hrm.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('hrm.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:skills,name',
        ]);

        $skill = Skill::create($data);

        if ($request->expectsJson()) {
            return response()->json($skill, 201);
        }

        return redirect()->route('skills.index')->with('success', 'Skill created.');
    }
}
