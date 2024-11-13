<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = Student::all();

        return view('pages.students.index', compact('data'));
    }

    public function create()
    {
        $data['users'] = User::query()
            ->whereDoesntHave('student')
            ->where('role', 'student')
            ->select('id', 'name')
            ->get();

        return view('pages.students.form', compact('data'));
    }

    public function store(Request $request)
    {
        $inputData = $request->validate([
            'user_id' => 'nullable|unique:students|exists:users,id',
            'nis' => 'required|unique:students',
            'name' => 'required',
            'class_name' => 'required',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'parent_name' => 'required',
        ]);

        Student::create($inputData);

        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        $data['student'] = $student;
        $data['users'] = User::query()
            ->whereDoesntHave('student')
            ->where('role', 'student')
            ->orWhere('id', $student->user_id)
            ->select('id', 'name')
            ->get();

        return view('pages.students.form', [
            'student' => $student,
            'data' => $data
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $inputData = $request->validate([
            'user_id' => 'nullable|exists:users,id|unique:students,user_id,' . $student->id,
            'nis' => 'required|unique:students,nis,' . $student->id,
            'name' => 'required',
            'class_name' => 'required',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'parent_name' => 'required',
        ]);

        $student->update($inputData);

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
