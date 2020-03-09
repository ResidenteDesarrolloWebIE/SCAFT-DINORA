<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createQuotationpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('amount');
            $table->date('date_amount');
            $table->tinyInteger('approval')->nullable();
            $table->double('exchange');

            $table->unsignedBigInteger('service_quotation_id')->nullable();
            $table->foreign('service_quotation_id')->references('id')->on('services_quotations');
            $table->unsignedBigInteger('product_quotation_id')->nullable();
            $table->foreign('product_quotation_id')->references('id')->on('products_quotations');
            $table->unsignedBigInteger('cat_coin_id')->nullable();
            $table->foreign('cat_coin_id')->references('id')->on('cat_coins');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
