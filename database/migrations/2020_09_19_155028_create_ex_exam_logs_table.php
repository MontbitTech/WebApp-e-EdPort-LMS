<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExExamLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('ex_examination_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('classroom_examination_mapping_id');
            $table->unsignedInteger('student_id');
            $table->time('remaining_time');
            $table->json('logs');
            $table->integer('disconnected_count');

            $table->foreign('classroom_examination_mapping_id')->references('id')->on('ex_classroom_examination_mappings');
            $table->foreign('student_id')->references('id')->on('tbl_students');

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
        Schema::dropIfExists('ex_exam_logs');
    }
}
