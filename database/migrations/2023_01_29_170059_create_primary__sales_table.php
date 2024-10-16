<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimarySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary__sales', function (Blueprint $table) {
            $table->id();
            $table->integer('select_company_id');
            $table->integer('medicine_id');
            $table->integer('batch_no');
            $table->integer('mrp');
            $table->date('expiry_date');
            $table->integer('quantity');
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
        Schema::dropIfExists('primary__sales');
    }
}
