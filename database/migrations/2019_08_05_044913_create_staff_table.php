<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email_address')->unique();
            $table->date('date_of_birth');
            $table->string('phone_number')->unique();
            $table->string('alt_phone_number');
            $table->text('address');
            $table->integer('nid');
            $table->string('passport')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('image');
            $table->tinyInteger('designation');
            $table->string('staff_id');
            $table->tinyInteger('department');
            $table->tinyInteger('location');
            $table->date('start_date');
            $table->double('salary', 10,2);
            $table->string('first_person_name');
            $table->string('first_person_phone_number');
            $table->string('first_person_relationship');
            $table->string('second_person_name');
            $table->string('second_person_phone_number');
            $table->string('second_person_relationship');
            $table->string('user_type');
            $table->string('password');
            $table->string('status');
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
        Schema::dropIfExists('staff');
    }
}
