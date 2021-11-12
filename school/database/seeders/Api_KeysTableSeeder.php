<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Users;
use App\Models\Api_keys;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Api_KeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("api__keys")->delete();

         $users = new Users;
         $users = Users::all();

         DB::statement("ALTER TABLE api__keys AUTO_INCREMENT=1");
         foreach($users as $user){
                     Api_keys::insert([
                         [
                             "user_id" => $user->id,
                             "key" => hash('sha256',Str::random(60))
                         ]
                         ]);         
  
         }
      
       

    }
}
