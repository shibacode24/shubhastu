<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotorsalemedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotorsalemedicine', function (Blueprint $table) {
            $table->id();
            $table->string('promotor__sales_id');
            $table->string('role');
            $table->string('select_medicine1');
            $table->string('ptrs');
            $table->string('mpss');
            $table->string('qntys');
            $table->string('select_batchs');
            $table->string('qnty_mps_total');
            $table->string('qnty_ptr_total');
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
        Schema::dropIfExists('promotorsalemedicine');
    }
}
