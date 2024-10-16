<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewmedicinemasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newmedicinemaster', function (Blueprint $table) {
            $table->id();
            $table->string('select_company_id');
            $table->string('medicine_id');
            $table->string('batch_no');
            $table->date('expiry_date');
            $table->string('quantity');
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
        Schema::dropIfExists('newmedicinemaster');
    }
}
