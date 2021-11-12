<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use  Faker\Factory as Faker;
use App\Models\Teachers;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("Teachers")->delete();
        
         $faker = Faker::create();
       
         DB::statement("ALTER TABLE teachers AUTO_INCREMENT=1");

        foreach(range(1,50) as $index)
        {
            Teachers::insert([
                [
                    "name"=>$faker->name,
                    "address"=>$faker->address,
                    "phone" => $faker->phoneNumber
                ]
                ]); 

     
        }
     
    }
}
