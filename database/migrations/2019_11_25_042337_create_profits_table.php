<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('guest_id');
            $table->unsignedInteger('air_id')->nullable();
            $table->unsignedInteger('pack_id')->nullable();
            $table->unsignedInteger('visa_id')->nullable();
            $table->unsignedInteger('hotel_id')->nullable();
            $table->date('profit_date')->nullable();
            $table->decimal('amount')->default(0.00);
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
        Schema::dropIfExists('profits');
    }
}
