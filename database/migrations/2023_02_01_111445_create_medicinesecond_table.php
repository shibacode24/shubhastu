<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesecondTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinesecond', function (Blueprint $table) {
            $table->id();
            $table->string('select_company_id');
            $table->string('medicine_id');
            $table->integer('batch_no');
            $table->string('mrp');
            $table->string('given_gst');
            $table->string('purchase');
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
        Schema::dropIfExists('medicinesecond');
    }
}
