<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\course_student;
use App\Models\Courses;
use App\Models\Students;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        $students = new course_student ;
        $students = DB::table('course_students')->where('course_id','=',$course_id)->get();
        if(count($students)>0)
        {
            return response()->json($students,200);
        }

        return response()->json('Courses not assign to given Teacher id',401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$course_id,$student_id)
    {
        $course = Courses::find($course_id);
        $student = Students::find($student_id);
        if(isset($course) && isset($student))
        {
            $enrolledStudent = course_student::where('course_id', '=' , $course_id)->where('student_id' , '=',$student_id)->get();
            if(count($enrolledStudent)>0)
            {
               return response()->json('student already enroll to this course');
            }
            $this->validate($request,[ 
                'course_id' => 'required|integer',
                'student_id' => 'required|integer'
                
             ]);

            $newStudentEnroll = new course_student;

            $newStudentEnroll->course_id = $request->input('course_id');
            $newStudentEnroll->student_id = $request->input('student_id');
            $newStudentEnroll->save();
           
            return response()->json('student added',200);


           
        }
        else{
            return response()->json('please provide valid id',401);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id,$student_id)
    {
        $course = Courses::find($course_id);
        $student = Students::find($student_id);
        if(isset($course) && isset($student))
        {
            $enrolledStudent = course_student::where('course_id', '=' , $course_id)->where('student_id' , '=',$student_id)->get();
            if(count($enrolledStudent)>0)
            {
               $enrolledStudent[0]->delete();
               return response()->json('student deleted from course',200);
            }
        }
        else{
            return response()->json('please provide valid id',401);
        }
    }
}
