<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;
protected $fillable =[
   // id, title, description,value (numeric), teacher_id (refernces id of teachers table)
   'title',
   'description',
   'value',
   'teacher_id'
];

}
