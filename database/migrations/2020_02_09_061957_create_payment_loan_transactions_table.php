<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLoanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_loan_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_loan_id')->nullable();
            $table->unsignedBigInteger('pl_installment_id')->nullable();
            $table->unsignedBigInteger('ins_payment_id')->nullable();
            $table->date('transaction_date');
            $table->text('narration');
            $table->decimal('debit_amount')->default(0.00);
            $table->decimal('credit_amount')->default(0.00);
            $table->decimal('blance')->default(0.00);
            $table->decimal('loan_blance')->default(0.00);
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
        Schema::dropIfExists('payment_loan_transactions');
    }
}
