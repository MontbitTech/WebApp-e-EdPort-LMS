<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_student_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('examination_question_mapping_id');
            $table->unsignedInteger('student_id');
            $table->text('answer');
            $table->decimal('marks',3,1);

            $table->foreign('examination_question_mapping_id')->references('id')->on('ex_examination_question_mappings');
            $table->foreign('student_id')->references('id')->on('tbl_students');

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
        Schema::dropIfExists('ex_student_answers');
    }
}
