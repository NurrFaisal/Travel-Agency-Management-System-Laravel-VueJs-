<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_receiveds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('guest');
            $table->unsignedInteger('staff');
            $table->decimal('bill_amount');
            $table->decimal('total_received_amount');
            $table->decimal('due_amount');
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
        Schema::dropIfExists('money_receiveds');
    }
}
