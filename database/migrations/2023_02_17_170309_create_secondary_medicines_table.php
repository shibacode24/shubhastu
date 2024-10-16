<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('secondary__sales_id');
            $table->string('select_medicine');
            $table->string('select_batch');
            $table->string('qnty');
            $table->string('purchase_rate');
            $table->string('qntypurchase');

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
        Schema::dropIfExists('secondary_medicines');
    }
}
