<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api_Keys extends Model
{
   protected $fillable=[ //id(auto incriment), user_id(refernces id of users table), key(unique,string)
    'user_id',
    'key'
   ];
}
