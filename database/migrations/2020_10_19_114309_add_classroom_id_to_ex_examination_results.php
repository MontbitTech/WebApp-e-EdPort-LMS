<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassroomIdToExExaminationResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ex_examination_results', function (Blueprint $table) {
            $table->unsignedInteger('classroom_id')->after('examination_id');

            $table->foreign('classroom_id')->references('id')->on('tbl_student_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ex_examination_results', function (Blueprint $table) {
            $table->dropForeign('ex_examination_results_classroom_id_foreign');
            $table->dropColumn('classroom_id');
        });
    }
}
