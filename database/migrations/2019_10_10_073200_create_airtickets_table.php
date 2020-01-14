<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sell_person');
            $table->string('destination');

            $table->integer('adult_qty');
            $table->decimal('adult_price');
            $table->decimal('adult_total_price');

            $table->integer('child_qty')->nullable();
            $table->decimal('child_price')->nullable();
            $table->decimal('child_total_price')->nullable();

            $table->integer('infant_qty')->nullable();
            $table->decimal('infant_price')->nullable();
            $table->decimal('infant_total_price')->nullable();

            $table->integer('ssr_qty')->nullable();
            $table->decimal('ssr_price')->nullable();
            $table->decimal('ssr_total_price')->nullable();

            $table->decimal('service_amount')->nullable();
            $table->decimal('total_amount');
            $table->decimal('total_net_price');
            $table->decimal('total_price');

            $table->unsignedInteger('selling_to');

            $table->text('word');
            $table->text('note')->nullable();

            $table->date('journey_date');
            $table->date('return_date');
            $table->tinyInteger('ticket_class');
            $table->tinyInteger('food_rules');
            $table->tinyInteger('date_change')->default(1);
            $table->text('narration')->nullable();
            $table->tinyInteger('ticket_type');
            $table->tinyInteger('ticket_rules');
            $table->tinyInteger('luggages_rules')->nullable();
            $table->text('luggages_rules_description')->nullable();
            $table->tinyInteger('hand_luggages_rules')->nullable();
            $table->text('hand_luggages_rules_description')->nullable();


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
        Schema::dropIfExists('airtickets');
    }
}
