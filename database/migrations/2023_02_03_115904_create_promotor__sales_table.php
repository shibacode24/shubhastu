<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotorSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotor__sales', function (Blueprint $table) {
            $table->id();
            $table->integer('year_id');
            $table->string('sale_of_month');
            $table->integer('select_company_id');
            $table->integer('select_marketing_id');
            $table->integer('select_doctor_id');
            $table->string('select_stokist_id');
            $table->integer('select_medical_id');
            $table->integer('select_scheme');
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
        Schema::dropIfExists('promotor__sales');
    }
}
