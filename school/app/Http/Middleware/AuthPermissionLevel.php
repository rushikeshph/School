<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users;
use App\Models\Api_keys;
use Illuminate\Support\Facades\DB;

class AuthPermissionLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$level)
    {
        // Pre-Middleware Action
        $apikey = $request->bearerToken();
        
       $user_ApiDetails = new Api_keys;
        
       $user_ApiDetails = DB::table('api__keys')
       ->where('key', '=', $apikey)
       ->get();
        
       $userDetails =  Users::find($user_ApiDetails[0]->user_id);

       if (isset($userDetails)){
			$userPermission = $userDetails->permission_level;
			
			if($userPermission < $level) {
				return response()->json('User has not valid permissions ', 404);
			}
		} else {
			return response()->json('User Not Found', 404);
		}    

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
