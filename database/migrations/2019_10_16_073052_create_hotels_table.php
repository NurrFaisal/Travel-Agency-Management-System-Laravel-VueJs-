<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('hotel_booking_id');

            $table->string('hotel_name');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('number_of_persons');
            $table->integer('number_of_room');
            $table->string('hotel_booking_ref');
            $table->decimal('net_price');
            $table->unsignedInteger('suplier');
            $table->string('room_category');
            $table->text('note')->nullable();
            $table->text('address')->nullable();
            $table->integer('king_size')->nullable();
            $table->integer('couple')->nullable();
            $table->integer('twin')->nullable();
            $table->integer('triple')->nullable();
            $table->integer('quared')->nullable();
            $table->decimal('king_size_price')->nullable();
            $table->decimal('couple_price')->nullable();
            $table->decimal('twin_price')->nullable();
            $table->decimal('triple_price')->nullable();
            $table->decimal('quared_price')->nullable();
            $table->integer('room_qty');
            $table->decimal('room_total_price');
            $table->integer('extra_bed_qty')->nullable();
            $table->decimal('extra_bed_price')->nullable();
            $table->decimal('extra_bed_total_price')->nullable();
            $table->integer('breakfast_qty')->nullable();
            $table->decimal('breakfast_price')->nullable();
            $table->decimal('breakfast_total_price')->nullable();
            $table->integer('early_check_in_qty')->nullable();
            $table->decimal('early_check_in_price')->nullable();
            $table->decimal('early_check_in_total_price')->nullable();
            $table->integer('late_check_out_qty')->nullable();
            $table->decimal('late_check_out_price')->nullable();
            $table->decimal('late_check_out_total_price')->nullable();
            $table->decimal('total_hotel_price');
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
        Schema::dropIfExists('hotels');
    }
}
