<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassworkIdColumnToTblClasswork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_classwork', function (Blueprint $table) {
            $table->string('google_classwork_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_classwork', function (Blueprint $table) {
            $table->dropColumn('google_classwork_id');
        });
    }
}
