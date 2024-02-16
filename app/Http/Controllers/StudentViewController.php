<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('academic', 'country')->get();
        return view('index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createStudent(){
        return view('Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'address' => 'required|string',
            'course' => 'required|string',
            'year' => 'required|string',
            'continent' => 'required|string',
            'country_name' => 'required|string',
            'capital' => 'required|string',
        ]);
    
        $student = Student::create([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'address' => $request->input('address'),
        ]);
    
        $academicData = [
            'course' => $request->input('course'),
            'year' => $request->input('year'),
        ];
    
        $countryData = [
            'continent' => $request->input('continent'),
            'country_name' => $request->input('country_name'),
            'capital' => $request->input('capital'),
        ];
    
        $student->academic()->create($academicData);
        $student->country()->create($countryData);
    
        return redirect()->route('index')->with("message", "Student Successfully Created");
    }
    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('academic', 'country')->findOrFail($id);

        if (!$student) {
            return view('Index');
        } 

        return view('Edit', compact('student'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('index')->with("error", "Student not found");
        }

        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'address' => 'required|string',
            'course' => 'required|string',
            'year' => 'required|string',
            'continent' => 'required|string',
            'country_name' => 'required|string',
            'capital' => 'required|string',
        ]);

        $student->update([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'address' => $request->input('address'),
        ]);

        $academicData = [
            'course' => $request->input('course'),
            'year' => $request->input('year'),
        ];

        $countryData = [
            'continent' => $request->input('continent'),
            'country_name' => $request->input('country_name'),
            'capital' => $request->input('capital'),
        ];

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

        return redirect()->route('index')->with("message", "Student Data Successfully Updated");
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

        return redirect()->route('index')->with("message", "Student Successfully Deleted");
    }
}
