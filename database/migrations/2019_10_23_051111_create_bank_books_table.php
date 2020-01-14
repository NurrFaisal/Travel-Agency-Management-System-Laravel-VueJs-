<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('received_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('contra_id')->nullable();
            $table->unsignedInteger('bank_name');
            $table->date('bank_date');
            $table->text('narration');
            $table->decimal('debit_bank_amount')->default(0);
            $table->decimal('credit_bank_amount')->default(0);
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
        Schema::dropIfExists('bank_books');
    }
}
