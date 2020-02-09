<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('pl_date');
            $table->string('pl_name');
            $table->tinyInteger('cash')->nullable();
            $table->tinyInteger('cheque')->nullable();
            $table->decimal('total_payment_loan_amount');
            $table->text('narration');
            $table->string('received_by');
            $table->string('paid_by');
            $table->string('approved_by');
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
        Schema::dropIfExists('payment_loans');
    }
}
