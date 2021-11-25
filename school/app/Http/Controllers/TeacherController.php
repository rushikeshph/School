<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Courses;
use App\Models\Teachers;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $teachers_list = Teachers::all();
        if(isset($teachers_list))
        {
            return response()->json($teachers_list,200);
        }
        return response()->json('There is not teachers data');
       
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
    public function store(Request $request)
    {
     $this->validate($request,[ 
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|min:10|max:10'
        ]);

       $newTeacher = new Teachers;
        
       $newTeacher->name =  $request->input('name');
       $newTeacher->address =  $request->input('address');
       $newTeacher->phone =  $request->input('phone');
       
   
       $newTeacher->save();
        
       return response()->json($newTeacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($teacher_id)
    {
         $teacher = Teachers::find($teacher_id);

         if(is_null($teacher))
         {
             return response()->json('Teachers with given '.$teacher_id.' not found',404);
         }
         
         return response()->json($teacher,200);        
      

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
    public function update(Request $request, $teacher_id)
    {
        $teacher = Teachers::find($teacher_id);
        if(is_null($teacher))
        {
            return response()->json('Teacher with given id not found',401);
        }
       if($request->method() == 'PUT'){
               $this->validate($request,[ 
                    'name' => 'required|string',
                    'address' => 'required|string',
                    'phone' => 'required|string|min:10|max:10'
                   ]);
       
                 $teacher->name =  $request->input('name');
                 $teacher->address =  $request->input('address');
                 $teacher->phone =  $request->input('phone');
                 $teacher->save();

               return response()->json('teacher updated succesfully',200);
    }else{
      
        $inputs =  $this->validate($request,[ 
            'name' => 'string',
            'address' => 'string',
            'phone' => 'string|min:10|max:10'
           ]);

           $teacher->update($inputs);

           return response()->json('teacher updated succesfully',200);

    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id)
    {
        $teacher = Teachers::find($teacher_id);
         if(is_null($teacher))
         {
             return response()->json('teacher not found');
         }
         else{
             $teacher_courses = DB::table('courses')->where('teacher_id','=',$teacher_id)->get();
             if(isset($teacher_courses))
             {
                return response()->json('active courses assign to this teacher please delete courses first');
             }
             else{
                    $teacher->delete();
                    return response()->json('teacher deleted successfully '.$teacher_id,200);
             }

         }
    }
}
