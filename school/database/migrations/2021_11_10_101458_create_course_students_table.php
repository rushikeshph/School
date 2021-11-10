<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('course_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();;
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->integer('student_id')->unsigned();;
            $table->foreign('student_id')->references('id')->on('students')->onDelete('CASCADE');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_students');
    }
}
