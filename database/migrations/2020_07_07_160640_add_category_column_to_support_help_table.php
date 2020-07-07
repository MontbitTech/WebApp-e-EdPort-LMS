<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnToSupportHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_support_help', function (Blueprint $table) {
            $table->integer('help_ticket_category_id')->nullable();
//            $table->foreign('help_ticket_category_id')->references('id')->on('help_ticket_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_support_help', function (Blueprint $table) {
//            $table->dropForeign();
            $table->dropColumn('help_ticket_category_id');
        });
    }
}
