<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_student_classes', function (Blueprint $table) {
            			$table->increments("id");
			$table->integer("class_name");
			$table->char("section_name");
			$table->integer("subject_id");
			$table->string("g_class_id",100);
			$table->string("g_link",255);
			$table->text("g_response");
			$table->text("student_numbers")->nullable();
			$table->timestamp("created_at")->nullable();
			$table->timestamp("updated_at")->nullable();
			$table->integer("created_by")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_student_classes');
    }
}
