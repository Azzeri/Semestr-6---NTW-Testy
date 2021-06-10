<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_group', function (Blueprint $table) {
            $table->id();
            $table->string('student_album');
            $table->foreign('student_album')->references('album_student')->on('students');
            $table->foreignId('group_id')->constrained('groups');
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_group');
    }
}
