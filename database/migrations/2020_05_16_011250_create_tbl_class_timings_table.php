<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblClassTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_class_timings', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("class_id");
            $table->integer("subject_id");
            $table->integer("teacher_id");
            $table->char("class_day");
            $table->time("from_timing");
            $table->time("to_timing");
            $table->boolean("is_lunch")->nullable();
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
        Schema::dropIfExists('tbl_class_timings');
    }
}
