<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('expence_date');
            $table->unsignedInteger('expence_head');
            $table->boolean('cash')->nullable();
            $table->boolean('cheque')->nullable();
            $table->decimal('total_expence_amount');
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
        Schema::dropIfExists('expences');
    }
}
