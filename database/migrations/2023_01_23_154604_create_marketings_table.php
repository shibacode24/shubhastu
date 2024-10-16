<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->string('city_id');
            $table->string('select_company_id');
            $table->string('name');
            $table->integer('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('username');
            $table->string('password');
            $table->string('pan');
            $table->string('aadhar_card');
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
        Schema::dropIfExists('marketings');
    }
}
