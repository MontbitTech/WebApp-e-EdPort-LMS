<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeInCmsLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cmslinks', function (Blueprint $table) {
            $table->text('book_url')->change()->nullable();
            $table->text('link')->change()->nullable();
            $table->text('khan_academy')->change()->nullable();
            $table->text('youtube')->change()->nullable();
            $table->text('others')->change()->nullable();
            $table->text('assignment_link')->change()->nullable();
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
            $table->dropColumn('book_url');
            $table->dropColumn('link');
            $table->dropColumn('khan_academy');
            $table->dropColumn('youtube');
            $table->dropColumn('others');
             $table->dropColumn('assignment_link');
        });
    }
}
