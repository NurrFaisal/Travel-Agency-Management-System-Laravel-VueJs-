<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('guest_id');
            $table->unsignedInteger('staff_id');
            $table->string('subject');
            $table->text('query');
            $table->text('follow_up');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('guest_queries');
    }
}
