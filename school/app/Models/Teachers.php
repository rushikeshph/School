<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $fillable=[
       'name',
       'address',
       'phone'=> 'required|digits:10'
    ];

    
}
