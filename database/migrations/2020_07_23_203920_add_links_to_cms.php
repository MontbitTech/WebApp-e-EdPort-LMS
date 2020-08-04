<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinksToCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cmslinks', function (Blueprint $table) {
            $table->string('khan_academy')->nullable()->after('link');
            $table->string('youtube')->nullable()->after('khan_academy');
            $table->string('others')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_cmslinks', function (Blueprint $table) {
            $table->dropColumn('khan_academy');
            $table->dropColumn('youtube');
            $table->dropColumn('others');
        });
    }
}
