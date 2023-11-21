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
        $targets = Student::paginate(25);
        return view('student.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input_data = $request->all();
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $img_path = "storage/images/$fileName";

            $input_data['image'] = $img_path;
        }
        

        Student::create($input_data);
        return redirect()->route('students.index')->with('success', 'Student has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $old_img_path = $student->image;
        $input_data = $request->except(['_token', '_method']);
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $img_path = "storage/images/$fileName";

            $input_data['image'] = $img_path;
        }

        Student::whereId($student->id)->update($input_data);
        @unlink($old_img_path);
        return redirect()->route('students.index')->with('success', 'Student has been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        Student::whereId($student->id)->delete();
        @unlink($student->image);
        return back()->with('success', 'Student has been Deleted.');
    }
}
