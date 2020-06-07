<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblSupportHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_support_help', function (Blueprint $table) {
            			$table->increments("id");
			$table->integer("teacher_id");
			$table->smallInteger("help_type");
			$table->text("description");
			$table->text("class_join_link")->nullable();
			$table->integer("class_id")->nullable();
			$table->integer("subject_id")->nullable();
			$table->smallInteger("status")->default('1');
			$table->integer("read_status");
			$table->timestamp("created_at")->default('CURRENT_TIMESTAMP');
			$table->timestamp("updated_at")->default('0000-00-00 00:00:00');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_support_help');
    }
}
