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
    public function up()
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
			$table->timestamp("created_at")->nullable();
			$table->timestamp("updated_at")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_class_timings');
    }
}
