<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('title');
            $table->string('name');
            $table->date('date_of_birth');
            $table->tinyInteger('gender');
            $table->string('phone_number')->nullable();
            $table->string('passport_number');
            $table->date('pp_issue_date');
            $table->date('pp_expire_date');
            $table->unsignedInteger('airticket_id');
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
        Schema::dropIfExists('paxes');
    }
}
