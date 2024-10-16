<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkStockistMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link__stockist__medicals', function (Blueprint $table) {
            $table->id();
            $table->integer('select_city_id');
            $table->integer('select_company_id');
            $table->integer('select_stockist_id');
            $table->integer('select_medical_id');
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
        Schema::dropIfExists('link__stockist__medicals');
    }
}
