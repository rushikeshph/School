<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $student_list = Students::all();
        if(isset($student_list))
        {
            return response()->json('There is no students data');
        }

        return response()->json($student_list,200);
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
            'phone' => 'required|string|min:10|max:10',
            'career' => 'required|in:engineering,maths,physics'
         ]);

       $newStudent = new Students;
        
       $newStudent->name =  $request->input('name');
       $newStudent->address =  $request->input('address');
       $newStudent->phone =  $request->input('phone');
       $newStudent->career = $request->input('career');
       
   
       $newStudent->save();
        
       return response()->json( $newStudent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        
        $student = Students::find($student_id);

        if(is_null($student))
        {
            return response()->json('student with given '.$student_id.' not found',404);
        }
        
        return response()->json($student,200);  
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
    public function update(Request $request, $student_id)
    {
        $student = Students::find($student_id);
        if(is_null($student))
        {
            return response()->json('student with given id not found',401);
        }
      if($request->method() == 'PUT'){
        $this->validate($request,[ 
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|min:10|max:10',
            'career' => 'required|in:engineering,maths,physics'
         ]);

        $student->name =  $request->input('name');
         $student->address =  $request->input('address');
         $student->phone =  $request->input('phone');
         $student->career = $request->input('career');

         $student->save();

        return response()->json('student updated succesfully',200);
      }
      else{
        $inputs =  $this->validate($request,[ 
            'name' => 'string',
            'address' => 'string',
            'phone' => 'string|min:10|max:10',
            'career' => 'string'
           ]);

           $student->update($inputs);

           return response()->json('student updated succesfully',200);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        $student = Students::find($student_id);
         if(is_null($student))
         {
             return response()->json('student not found');
         }
        
         $student->delete();
         return response()->json('student deleted successfully'.$student_id,200);
             
    
    }
}
