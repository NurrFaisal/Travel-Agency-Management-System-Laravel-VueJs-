<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaUpdatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_updateds', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->integer('urgent_qty')->nullable();
            $table->decimal('urgent_price')->nullable();
            $table->integer('online_visa_qty')->nullable();
            $table->decimal('online_visa_price')->nullable();
            $table->integer('notary_qty')->nullable();
            $table->decimal('notary_price')->nullable();
            $table->integer('invitation_letter_qty')->nullable();
            $table->decimal('invitation_letter_price')->nullable();
            $table->integer('land_valuation_qty')->nullable();
            $table->decimal('land_valuation_price')->nullable();
            $table->integer('lawyer_qty')->nullable();
            $table->decimal('lawyer_price')->nullable();
            $table->decimal('total_net_price');
            $table->decimal('total_price');
            $table->decimal('total_others_price');
            $table->decimal('grand_total_price');
            $table->date('received_date');
            $table->unsignedInteger('client');
            $table->unsignedInteger('sell_person');
            $table->text('invoice_narration');
            $table->text('word');
            $table->text('special_note');
            $table->bigInteger('state');

            $table->unsignedInteger('work_by')->nullable();
            $table->date('work_date')->nullable();
            $table->unsignedInteger('notary_by')->nullable();
            $table->date('notary_date')->nullable();
            $table->unsignedInteger('checked_by_asst')->nullable();
            $table->date('checked_by_asst_date')->nullable();
            $table->unsignedInteger('checked_by_officer')->nullable();
            $table->date('checked_by_officer_date')->nullable();
            $table->unsignedInteger('submit_by')->nullable();
            $table->date('submit_date')->nullable();
            $table->unsignedInteger('collected_by')->nullable();
            $table->date('collected_date')->nullable();
            $table->unsignedInteger('call_and_sms_by')->nullable();
            $table->date('call_and_sms_date')->nullable();
            $table->unsignedInteger('delevered_by')->nullable();
            $table->date('delevered_date')->nullable();
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
        Schema::dropIfExists('visa_updateds');
    }
}
