<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
protected $fillable =[
   // id, title, description,value (numeric), teacher_id (refernces id of teachers table)
   'title',
   'description',
   'value'=> 'require|numeric',
   'teacher_id'
];

}
