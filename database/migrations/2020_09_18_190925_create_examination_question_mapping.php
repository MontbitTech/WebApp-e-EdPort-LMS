<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationQuestionMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('ex_examination_question_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('examination_id');
            $table->unsignedInteger('classroom_id');
            $table->unsignedBigInteger('question_id');
            $table->decimal('marks', 3, 1);

            $table->foreign('examination_id')->references('id')->on('ex_examinations');
            $table->foreign('classroom_id')->references('id')->on('tbl_student_classes');
            $table->foreign('question_id')->references('id')->on('ex_questions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('ex_examination_question_mappings');
    }
}
