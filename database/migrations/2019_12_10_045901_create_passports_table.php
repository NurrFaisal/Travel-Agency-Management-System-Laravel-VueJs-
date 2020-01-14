<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('visa_updated_id');
            $table->string('name');
            $table->string('passport_number');
            $table->integer('no_of_books');
            $table->date('date_of_birth');
            $table->date('expire_date');
            $table->tinyInteger('type');
            $table->unsignedInteger('country');
            $table->unsignedInteger('suplier');
            $table->decimal('net_price');
            $table->decimal('price');
            $table->text('old_passport')->nullable();
            $table->text('narration');
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
        Schema::dropIfExists('passports');
    }
}
