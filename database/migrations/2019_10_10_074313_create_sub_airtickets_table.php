<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAirticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_airtickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('airticket_id');
            $table->date('issue_date');
            $table->date('departure_date');
            $table->date('return_date');
            $table->unsignedInteger('air_lines');
            $table->string('pnr');
            $table->string('sector');
            $table->decimal('net_price', 10,2);
            $table->decimal('price', 10,2);
            $table->unsignedInteger('suplier');
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
        Schema::dropIfExists('sub_airtickets');
    }
}
