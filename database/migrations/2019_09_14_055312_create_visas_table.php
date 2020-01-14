<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('date_of_birth');
            $table->string('pp_number');
            $table->integer('no_of_books');
            $table->date('pp_issue_date');
            $table->date('pp_expire_date');
            $table->tinyInteger('country');
            $table->tinyInteger('type');
            $table->tinyInteger('suplier');
            $table->tinyInteger('reference');
            $table->decimal('net_price');
            $table->decimal('price');
            $table->decimal('advance');
            $table->tinyInteger('sales_person');
            $table->date('received_date');
            $table->tinyInteger('work_by')->nullable();
            $table->date('work_date')->nullable();
            $table->tinyInteger('notary_by')->nullable();
            $table->date('notary_date')->nullable();
            $table->tinyInteger('checked_by_asst')->nullable();
            $table->date('checked_by_asst_date')->nullable();
            $table->tinyInteger('checked_by_officer')->nullable();
            $table->date('checked_by_officer_date')->nullable();
            $table->tinyInteger('submit_by')->nullable();
            $table->date('submit_date')->nullable();
            $table->tinyInteger('collected_by')->nullable();
            $table->date('collected_date')->nullable();
            $table->tinyInteger('call_and_sms_by')->nullable();
            $table->date('call_and_sms_date')->nullable();
            $table->tinyInteger('delevered_by')->nullable();
            $table->date('delevered_date')->nullable();
            $table->date('narration')->nullable();
            $table->tinyInteger('payment_status');
            $table->tinyInteger('state');
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
        Schema::dropIfExists('visas');
    }
}
