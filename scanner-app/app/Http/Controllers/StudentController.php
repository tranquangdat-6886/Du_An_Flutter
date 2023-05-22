<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $students = new Student();
        $students->code = $request->input('code');
        $students->lastname = $request->input('lastname');
        $students->firstname = $request->input('firstname');
        $students->dob = $request->input('dob');
        $students->save();
        return response()->json($students);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = Student::find($id);
        return response()->json($students);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $students = Student::find($id);
        $students->code = $request->input('code');
        $students->lastname = $request->input('lastname');
        $students->firstname = $request->input('firstname');
        $students->dob = $request->input('dbo');
        $students->save();
        return response()->json($students);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = Student::find($id);
        $students -> delete();
        return response()->json(['message' => 'Student deleted']);
    }
}
