<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblInviteTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_invite_teacher', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("class_id");
            $table->integer("teacher_id");
            $table->integer("subject_id")->nullable();
            $table->string("g_code", 500)->nullable();
            $table->text("g_responce")->nullable();
            $table->integer("is_accept")->nullable();

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
        Schema::dropIfExists('tbl_invite_teacher');
    }
}
