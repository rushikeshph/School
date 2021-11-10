<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable =[
      'name',
      'address',
      'phone'=> 'required|digits:10',
      'career'
    ];
}
