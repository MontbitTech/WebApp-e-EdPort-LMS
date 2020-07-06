<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 100);
            $table->integer("class_id");
            $table->string("email", 100)->nullable();
            $table->string("phone", 20)->nullable();
            $table->string("notify", 10)->nullable();

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
        Schema::dropIfExists('tbl_students');
    }
}
