<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Courses;
use App\Models\Teachers;

class TeacherCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id)
    {
        $teacher_courses = new Courses;
        $teacher_courses = DB::table('courses')->where('teacher_id','=',$teacher_id)->get();
        if(isset($teacher_courses))
        {
            return response()->json($teacher_courses,200);
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
    public function store(Request $request,$teacher_id)
    {
        $teacher = Teachers::find($teacher_id);

        if(is_null($teacher))
        {
            return response()->json('Teachers with given '.$teacher_id.' not found please provide valid teacher id',401);
        }
        $this->validate($request,[ 
            'title' => 'required|string',
            'description' => 'required|string',
            'value' => 'required|integer'
          ]);

        $newCourse = new Courses;
         
        $newCourse ->title =  $request->input('title');
        $newCourse ->description =  $request->input('description');
        $newCourse ->value =  $request->input('value');
        $newCourse->teacher_id = $teacher_id;
        $newCourse->save();
        
        return response()->json($newCourse,200);

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
    public function update(Request $request,$teacher_id,$course_id)
    {
       
        $update_course = Courses::where('id', '=' , $course_id)->where('teacher_id' , '=',$teacher_id)->get();
   
       if(count($update_course)==0)
        {
            return response()->json('Please provide valid teacher and course id',401);
        }
       
       
         
       if($request->method() == 'PUT'){
            $this->validate($request,[ 
                'title' => 'required|string',
                'description' => 'required|string',
                'value' => 'required|integer',
                
             ]);
    
             $update_course[0]->title =  $request->input('title');
             $update_course[0]->description =  $request->input('description');
             $update_course[0]->value =  $request->input('value');
             $update_course[0]->teacher_id = $teacher_id;
    
           // return response()->json($update_course);

             $update_course[0]->save();
    
            return response()->json("course updated succesfully",200);
          }
          else{
            $inputs =  $this->validate($request,[ 
                'title' => 'string',
                'description' => 'string',
                'value' => 'integer',
                'teacher_id' => 'integer'
               ]);
    
               $update_course[0]->update($inputs);
    
               return response()->json('course updated succesfully',200);
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id,$course_id)
    {
        $delete_course = Courses::where('id', '=' , $course_id)->where('teacher_id' , '=',$teacher_id)->get();
   
        if(count($delete_course)==0)
         {
             return response()->json('Please provide valid teacher and course id',401);
         }

         $delete_course[0]->delete();
         return response()->json('deleted',200);

        
    }
}
