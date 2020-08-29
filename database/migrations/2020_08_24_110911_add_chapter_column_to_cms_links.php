<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChapterColumnToCmsLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cmslinks', function (Blueprint $table) {
            $table->string('chapter')->after('subject')->nullable();
            $table->string('book_url')->after('topic')->nullable();
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
            $table->dropColumn('chapter');
            $table->dropColumn('book_url');
        });
    }
}
