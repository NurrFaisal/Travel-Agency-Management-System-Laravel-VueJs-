<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('branch');
            $table->string('name');
            $table->unsignedInteger('guest_type');
            $table->unsignedInteger('designation');
            $table->unsignedInteger('rf_staff');
            $table->string('rf_guest');
            $table->string('email_address');
            $table->string('alt_email_address');
            $table->string('phone_number');
            $table->string('alt_phone_number');
            $table->text('address');
            $table->tinyInteger('category');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
