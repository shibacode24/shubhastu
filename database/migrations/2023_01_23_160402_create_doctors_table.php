<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('allotted_dr_name');
            $table->string('hospital_address');
            $table->integer('mobile');
            $table->string('email');
            $table->string('promoter_name');
            $table->integer('account_number');
            $table->string('ifsc');
            $table->string('pan_no');
            $table->string('username');
            $table->string('password');
            $table->integer('city_id');
            $table->string('medical_id');
            $table->string('Scheme');
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
        Schema::dropIfExists('doctors');
    }
}
