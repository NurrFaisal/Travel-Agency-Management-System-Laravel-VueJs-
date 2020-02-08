<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedLoanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_loan_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('received_loan_id')->nullable();
            $table->unsignedInteger('rl_installment_id')->nullable();
            $table->date('transaction_date');
            $table->text('narration');
            $table->decimal('debit_amount');
            $table->decimal('credit_amount');
            $table->decimal('blance');
            $table->decimal('loan_blance');
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
        Schema::dropIfExists('received_loan_transactions');
    }
}
