<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('contra_type');
            $table->date('contra_date');
            $table->decimal('contra_amount');
            $table->tinyInteger('from_bank_name')->nullable();
            $table->tinyInteger('to_bank_name')->nullable();
            $table->tinyInteger('bank_name')->nullable();
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
        Schema::dropIfExists('contras');
    }
}
