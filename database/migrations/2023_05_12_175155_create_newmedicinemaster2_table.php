<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewmedicinemaster2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newmedicinemaster2', function (Blueprint $table) {
            $table->id();
            $table->string('newmedicinemaster_id');

            $table->string('role');
            // $table->integer('batch_no');
            // $table->string('mrp');
            // $table->string('given_gst');
            // $table->string('purchase');
            $table->string('gst');
            $table->string('amount_after_gst');
            $table->string('retail_margin');
            $table->string('ptr');
            $table->string('stockist_margin');
            $table->string('pts');
            $table->string('management');
            $table->string('promotion_cost');
            $table->string('scheme');
            $table->string('default_scheme');
            $table->string('scheme_amount_deduct');
            $table->string('transport_expiry_breakage');
            $table->string('tot');
            $table->string('marketing_working_cost');
            $table->string('company_profit');
            $table->string('percent_profit_to_investment');
            $table->string('marketing_promotion_scheme');
            $table->string('percent_profit_to_ptr');
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
        Schema::dropIfExists('newmedicinemaster2');
    }
}
