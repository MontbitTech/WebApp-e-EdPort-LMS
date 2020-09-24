<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClassroomExaminationMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_classroom_examination_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('examination_id');
            $table->unsignedInteger('classroom_id');
            $table->time('duration');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->json('examination_properties')->nullable();

            $table->foreign('examination_id')->references('id')->on('ex_examinations');
            $table->foreign('classroom_id')->references('id')->on('tbl_student_classes');

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
        Schema::dropIfExists('ex_classroom_examination_mappings');
    }
}
