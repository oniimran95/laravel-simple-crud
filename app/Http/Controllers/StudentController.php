<?php

namespace App\Http\Controllers;

use App\Models\TClass;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

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
    public function store(StoreStudentRequest $request, Student $student)
    {

        DB::transaction(function() use ($request, $student) {
        $input_data = $request->validated();
        $student_items = ['name', 'email', 'date_of_birth'];
        $class_items = ['t_class_id', 'reg_no', 'roll_no', 'result', 'status'];

            $student_data = array_diff_key($input_data, array_flip($class_items));
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/images', $fileName);
                $img_path = "storage/images/$fileName";

                $input_data['image'] = $img_path;
            }
            

            $student_info = Student::create($input_data);
            
            $class_data = array_diff_key($input_data, array_flip($student_items));
            $class_data['student_id'] = $student_info->id;
            StudentClass::create($class_data);
            @unlink($old_img_path);
        });
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
        $student_class = StudentClass::where('student_id', $student->id)->first();
        $initialData = $this->initialData();
        return view('student.edit', compact('student', 'initialData', 'student_class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        DB::transaction(function() use ($request, $student) {
            $old_img_path = $student->image;
            $input_data = $request->validated();
            $student_items = ['name', 'email', 'date_of_birth', 'image'];
            $class_items = ['t_class_id', 'reg_no', 'roll_no', 'result', 'status'];

            $student_data = array_diff_key($input_data, array_flip($class_items));
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/images', $fileName);
                $img_path = "storage/images/$fileName";

                $student_data['image'] = $img_path;
            }
            Student::whereId($student->id)->update($student_data);


            $class_data = array_diff_key($input_data, array_flip($student_items));
            StudentClass::whereStudentId($student->id)->update($class_data);
            @unlink($old_img_path);
        });
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
        $statuss = ['running', 'completed', 'droped', 'rejected'];

        return [
            'classes' => $classes,
            'results' => $results,
            'statuss' => $statuss,
        ];
    }
}
