<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePLInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_l_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('pl_installment_date');
            $table->unsignedInteger('loan_id');
            $table->tinyInteger('cash');
            $table->tinyInteger('bank');
            $table->tinyInteger('cheque');
            $table->decimal('total_payment_loan_installment_amount',10,2);
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
        Schema::dropIfExists('p_l_installments');
    }
}
