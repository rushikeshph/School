<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users;
use App\Models\Api_Keys;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AuthenticateUserKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
   
        $user_apikey = new Api_keys;

        $apikey = $request->bearerToken();
        $user_id = $request->id;

        if ($apikey && $user_id) {
              
            $user_apikey = DB::table('api__keys')
            ->where('user_id', '=', $user_id)
            ->get();
             
           if(count($user_apikey)==0)
           {
               return response()->json('user id not found');
           }
            if($user_apikey[0]->key != $apikey )
            {
                return response()->json('Please Provide valid key',404);
            }
		

		}
        else{
            return response()->json('Please provide valid data',404);
        }
        

        $response = $next($request);

        return $response;
    }
}
