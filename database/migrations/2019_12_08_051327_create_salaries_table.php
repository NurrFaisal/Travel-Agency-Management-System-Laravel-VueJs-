<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('salary_date');
            $table->unsignedInteger('staff');
            $table->boolean('cash')->nullable();
            $table->boolean('bank')->nullable();
            $table->boolean('cheque')->nullable();
            $table->decimal('total_salary_amount');
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
        Schema::dropIfExists('salaries');
    }
}
