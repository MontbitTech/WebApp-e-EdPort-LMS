<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelledColumnToDateclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_dateclass', function (Blueprint $table) {
            $table->boolean('cancelled')->default(0)->after('live_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_dateclass', function (Blueprint $table) {
            $table->dropColumn('cancelled');
        });
    }
}
