<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_settings', function (Blueprint $table) {
            $table->increments("id");
            $table->string("item", 100);
            $table->string("value", 4000)->nullable();
            $table->string('folder')->nullable();
            $table->string('permission')->nullable();

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
        Schema::dropIfExists('tbl_settings');
    }
}
