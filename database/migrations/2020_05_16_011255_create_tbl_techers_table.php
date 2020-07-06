<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTblTechersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('tbl_techers', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name", 100);
            $table->string("email", 100);
            $table->string("phone", 100);
            $table->string("address", 255)->nullable();
            $table->string("city", 50)->nullable();
            $table->string("state", 50)->nullable();
            $table->string("pincode", 20)->nullable();
            $table->string("login_pin", 20)->nullable();
            $table->string("g_user_id", 100)->nullable();
            $table->string("g_customer_id", 100)->nullable();
            $table->text("g_response")->nullable();
            $table->string("photo", 255)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('tbl_techers');
    }
}
