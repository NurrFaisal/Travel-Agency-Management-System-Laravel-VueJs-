<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransjactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transjactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('guest_id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('air_id')->nullable();
            $table->unsignedInteger('pack_id')->nullable();
            $table->unsignedInteger('visa_id')->nullable();
            $table->unsignedInteger('hotel_id')->nullable();
            $table->unsignedInteger('received_id')->nullable();
            $table->unsignedInteger('discount_id')->nullable();
            $table->date('transjaction_date');
            $table->text('narration');
            $table->decimal('debit_amount');
            $table->decimal('credit_amount');
            $table->decimal('blance');
            $table->decimal('guest_blance');
            $table->decimal('staff_blance');
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
        Schema::dropIfExists('transjactions');
    }
}
