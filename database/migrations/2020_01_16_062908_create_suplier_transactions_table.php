<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuplierTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suplier_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('suplier_id')->nullable();
            $table->unsignedBigInteger('air_id')->nullable();
            $table->unsignedBigInteger('pack_id')->nullable();
            $table->unsignedBigInteger('visa_id')->nullable();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->unsignedBigInteger('debit_voucher_id')->nullable();
            $table->date('transaction_date')->nullable();
            $table->text('narration')->nullable();
            $table->decimal('debit_amount')->nullable();
            $table->decimal('credit_amount')->nullable();
            $table->decimal('balance');
            $table->decimal('suplier_balance');
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
        Schema::dropIfExists('suplier_transactions');
    }
}
