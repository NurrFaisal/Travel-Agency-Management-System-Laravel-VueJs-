<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('rl_date');
            $table->unsignedBigInteger('rl_head');
            $table->tinyInteger('cash')->nullable();
            $table->tinyInteger('bank')->nullable();
            $table->tinyInteger('cheque')->nullable();
            $table->decimal('total_received_loan_amount');
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
        Schema::dropIfExists('received_loans');
    }
}
