<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('guest');
            $table->unsignedInteger('staff');
            $table->unsignedInteger('package_type');
            $table->string('country');
            $table->date('query_date');
            $table->string('destination');
            $table->string('duration');
            $table->integer('adult_qty')->nullable();
            $table->integer('child_qty')->nullable();
            $table->integer('infant_qty')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('hotel_cat');
            $table->integer('room_qty')->default(0);
            $table->integer('room_cat');
            $table->integer('king_size')->nullable();
            $table->integer('couple_size')->nullable();
            $table->integer('twin_size')->nullable();
            $table->integer('triple_size')->nullable();
            $table->integer('quared_size')->nullable();
            $table->integer('total_bed_qty')->nullable();
            $table->text('narration');
            $table->date('iti_submit_to_guest_date')->nullable();
            $table->text('adult_service')->nullable();
            $table->text('child_service')->nullable();
            $table->text('infant_service')->nullable();
            $table->decimal('total_net_price')->default(0);
            $table->decimal('adult_price')->nullable();
            $table->decimal('child_price')->nullable();
            $table->decimal('infant_price')->nullable();
            $table->decimal('total_price')->default(0);
            $table->decimal('adult_total_price')->default(0);
            $table->decimal('child_total_price')->default(0);
            $table->decimal('infant_total_price')->default(0);
            $table->decimal('total_total_price')->default(0);
            $table->integer('ex_night_qty')->nullable();
            $table->decimal('ex_night_net_price')->nullable();
            $table->decimal('ex_night_price')->nullable();
            $table->decimal('ex_night_total_price')->nullable();
            $table->text('ex_night_note')->nullable();
            $table->integer('ex_site_seeing_qty')->nullable();
            $table->decimal('ex_site_seeing_net_price')->nullable();
            $table->decimal('ex_site_seeing_price')->nullable();
            $table->decimal('ex_site_seeing_total_price')->nullable();
            $table->text('ex_site_seeing_note')->nullable();
            $table->integer('airport_rd_qty')->nullable();
            $table->decimal('airport_rd_net_price')->nullable();
            $table->decimal('airport_rd_price')->nullable();
            $table->decimal('airport_rd_total_price')->nullable();
            $table->text('airport_rd_note')->nullable();
            $table->integer('others_qty')->nullable();
            $table->decimal('others_net_price')->nullable();
            $table->decimal('others_price')->nullable();
            $table->decimal('others_total_price')->nullable();
            $table->text('others_note')->nullable();
            $table->decimal('grand_total_net_price')->nullable();
            $table->decimal('grand_total_price')->nullable();
            $table->date('journey_date')->nullable();
            $table->date('return_date')->nullable();
            $table->date('visa_submit_to_us')->nullable();
            $table->date('visa_submit_to_em')->nullable();
            $table->date('visa_done_date')->nullable();
            $table->date('visa_delivery_to_guest')->nullable();
            $table->tinyInteger('visa_confirmation')->nullable();
            $table->date('ticket_date')->nullable();
            $table->string('ticket_type')->nullable();
            $table->date('document_ready_date')->nullable();
            $table->date('document_delivery_date')->nullable();
            $table->integer('state');

            $table->text('extra_note')->nullable();

            $table->integer('first_qty')->nullable();
            $table->decimal('first_price')->nullable();
            $table->decimal('first_total_price')->nullable();

            $table->integer('second_qty')->nullable();
            $table->decimal('second_price')->nullable();
            $table->decimal('second_total_price')->nullable();

            $table->integer('third_qty')->nullable();
            $table->decimal('third_price')->nullable();
            $table->decimal('third_total_price')->nullable();

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
        Schema::dropIfExists('packages');
    }
}
