<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExplanationToExQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ex_questions', function (Blueprint $table) {
            $table->text('explanation')->nullable()->after('answer')->comment('explains why the ans is correct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ex_questions', function (Blueprint $table) {
            $table->dropColumn('explanation');
        });
    }
}
