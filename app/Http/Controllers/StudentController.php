<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('academic', 'country')->get();
        return response()->json(['students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {-
        $student = Student::create($request->all());

        $academicData = $request->input('academics');
        $countryData = $academicData['countries'];

        $student->academic()->create($academicData);
        $student->country()->create($countryData);

        return response()->json(['student' => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('academic', 'country')->find($id);

        if (!$student) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $student->update($request->all());

        $academicData = $request->input('academics');
        $countryData = $academicData['countries'];

        if ($student->academic) {
            $student->academic->update($academicData);
        } else {
            $student->academic()->create($academicData);
        }

        if ($student->country) {
            $student->country->update($countryData);
        } else {
            $student->country()->create($countryData);
        }

        return response()->json(['student' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($student->academic) {
            $student->academic->delete();
        }

        if ($student->country) {
            $student->country->delete();
        }

        $student->delete();

        return response()->json(['message' => 'Successfully deleted the user']);
    }
}
