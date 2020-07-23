<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblCmslinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_cmslinks', function (Blueprint $table) {
            $table->increments("id");
            $table->string("class", 10)->nullable();
            $table->integer("subject")->nullable();
            $table->string("topic", 100)->nullable();
            $table->string("link", 1000)->nullable();
            $table->string("khan_academy", 255)->nullable();
            $table->string("youtube", 255)->nullable();
            $table->string("others", 255)->nullable();
            $table->string("assignment_link", 255)->nullable();
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
        Schema::dropIfExists('tbl_cmslinks');
    }
}
