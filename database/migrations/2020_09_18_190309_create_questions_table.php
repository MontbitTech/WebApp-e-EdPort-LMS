<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question');
            $table->string('answer');
            $table->json('options')->nullable();
            $table->string('type_of_question');
            $table->string('class');
            $table->unsignedInteger('subject_id');
            $table->string('chapter');

            $table->foreign('subject_id')->references('id')->on('tbl_student_subjects');

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
        Schema::dropIfExists('ex_questions');
    }
}
