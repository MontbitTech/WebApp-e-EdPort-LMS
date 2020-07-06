<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblClassworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_classwork', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("class_id");
            $table->string("g_live_link", 250)->nullable();
            $table->string("g_class_id", 20);
            $table->string("classwork_type", 20);
            $table->string("topic_id", 20)->nullable();
            $table->integer("g_points")->nullable();
            $table->string("g_status", 20)->nullable();
            $table->string("g_action", 10)->nullable();
            $table->string("g_title", 250);
            $table->dateTime("g_due_date")->nullable();
            $table->integer("teacher_id")->nullable();
            $table->integer("subject_id")->nullable();

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
        Schema::dropIfExists('tbl_classwork');
    }
}
