<?php

namespace App\Http\Controllers;

use App\Models\TClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targets = Student::select(
                'students.*',
                't_classes.name AS class',
                'student_classes.reg_no',
                'student_classes.roll_no',
                'student_classes.result',
                'student_classes.status'
            )
            ->leftJoin('student_classes', 'student_classes.student_id', 'students.id')
            ->leftJoin('t_classes', 't_classes.id', 'student_classes.t_class_id')
            ->paginate(25);
        return view('student.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $initialData = $this->initialData();
        return view('student.create', compact('initialData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        // $request->validate([
        //     'name'              => 'required',
        //     'email'             => 'required|email',
        //     'date_of_birth'     => 'date_format:Y-m-d',
        //     'image'             => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        // ]);
        

        // $validate = Validator::make($request->all(), [
        //     'name'              => 'required',
        //     'email'             => 'required|email',
        //     'date_of_birth'     => 'date_format:Y-m-d',
        //     'image'             => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        // ],[
        //     'date_of_birth.date_format' => 'Please enter validate date format'
        // ]);

        // if($validate->fails()) {
        //     return back()->withErrors($validate->errors())->withInput();
        // }

        $input_data = $request->validated();
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
        $initialData = $this->initialData();
        return view('student.edit', compact('student', 'initialData'));
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

    private function initialData() 
    {
        $classes = TClass::pluck('name', 'id')->toArray();
        $results = ['A+', 'A', 'A-', 'B', 'C', 'D', 'F'];

        return [
            'classes' => $classes,
            'results' => $results
        ];
    }
}
