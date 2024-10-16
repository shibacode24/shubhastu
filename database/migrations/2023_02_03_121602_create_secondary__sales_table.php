<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondarySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary__sales', function (Blueprint $table) {
            $table->id();
            $table->integer('year_id');
            $table->string('sale_of_month');
            $table->integer('select_company_id');
            $table->string('select_stokist_id');
            $table->integer('sale_value');
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
        Schema::dropIfExists('secondary__sales');
    }
}
