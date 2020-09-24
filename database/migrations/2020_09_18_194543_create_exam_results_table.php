<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_examination_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('examination_id');
            $table->unsignedInteger('student_id');
            $table->decimal('total_marks',4,1);
            $table->decimal('marks_obtained',4,1);

            $table->foreign('examination_id')->references('id')->on('ex_examinations');
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
        Schema::dropIfExists('ex_examination_results');
    }
}
