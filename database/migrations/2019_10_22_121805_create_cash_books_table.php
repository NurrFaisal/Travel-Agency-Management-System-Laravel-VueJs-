<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('received_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('contra_id')->nullable();
            $table->text('narration');
            $table->decimal('debit_cash_amount')->default(0);
            $table->decimal('credit_cash_amount')->default(0);
            $table->decimal('blance')->default(0);
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
        Schema::dropIfExists('cash_books');
    }
}
