<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->delete();
        DB::statement("ALTER TABLE users AUTO_INCREMENT=1");
        //name, email, password, permission_level (integer)
        DB::table('users')->insert([
            [
           'name'=> 'Rushikesh',
           'email' => 'rushi@gmail.com',
           'password' => 'rushi123',
           'permission_level' => 200
        ],
        [
            'name'=> 'Deepak',
            'email' => 'deep@gmail.com',
            'password' => 'deep123',
            'permission_level' => 400
         ],
         [
            'name'=> 'Alok',
            'email' => 'alok@gmail.com',
            'password' => 'alok123',
            'permission_level' => 600
         ],
         [
            'name'=> 'pushpak',
            'email' => 'pushpak@gmail.com',
            'password' => 'pushpak123',
            'permission_level' => 800
         ]
        ]);
    }
}
