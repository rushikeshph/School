<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use  Faker\Factory as Faker;
use App\Models\Courses;
use App\Models\Teachers;


class CourseFactoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("courses")->delete();
        //title, description,value (numeric), teacher_id (refernces id of teachers table)
         $faker = Faker::create();
        
         DB::statement("ALTER TABLE courses AUTO_INCREMENT=1");

         
         $teachers_id = [];
         $teachers_id = Teachers::pluck('id')->all();
        
        foreach(range(1,10) as $index)
        {
            Courses::insert([
                [
                    "title"=>$faker->title,
                    "description"=>$faker->sentence(4),
                    "value" =>$faker->regexify('09[0-3]{7}'),
                    "teacher_id" => array_rand($teachers_id)
                ]
                ]); 

     
        }
     
     
    }
}
