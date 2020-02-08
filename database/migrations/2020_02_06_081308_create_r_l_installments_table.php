<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRLInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_l_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_id');
            $table->date('rl_installment_date');
            $table->tinyInteger('cash')->nullable();
            $table->tinyInteger('cheque')->nullable();
            $table->decimal('total_received_loan_installment_amount');
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
        Schema::dropIfExists('r_l_installments');
    }
}
