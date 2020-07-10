<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblDateclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dateclass', function (Blueprint $table) {
            $table->increments("id");
			$table->integer("class_id");
			$table->integer("subject_id");
			$table->integer("teacher_id");
			$table->integer("topic_id")->nullable();
			$table->time("from_timing");
			$table->time("to_timing");
			$table->date("class_date");
			$table->integer("timetable_id")->nullable();
			$table->string("live_link",255)->nullable();
			$table->string("ass_live_url",255)->nullable();
			$table->string("quiz_link",255)->nullable();
			$table->boolean("is_past")->default(0);
			$table->string("class_student_msg",255)->nullable();
			$table->string("class_description",255)->nullable();
			$table->string("g_meet_url",255)->nullable();
			$table->string("recording_url",255)->nullable();

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
        Schema::dropIfExists('tbl_dateclass');
    }
}
