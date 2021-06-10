<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Testunits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testunits', function (Blueprint $table) {
            $table->id();
            $table->boolean('finished')->default(false);
            $table->float('result')->nullable();
            $table->string('student_album');
            $table->foreign('student_album')->references('album_student')->on('students');
            $table->foreignId('test_id')->constrained('tests');
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
        Schema::drop('testunits');
    }
}
