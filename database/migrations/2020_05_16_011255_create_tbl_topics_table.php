<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_topics', function (Blueprint $table) {
            			$table->increments("id");
			$table->string("topicname",250);
			$table->integer("class_id");
			$table->string("g_topic_id",100);
			$table->timestamp("created_at")->default('CURRENT_TIMESTAMP')->nullable();
			$table->timestamp("updated_at")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_topics');
    }
}
