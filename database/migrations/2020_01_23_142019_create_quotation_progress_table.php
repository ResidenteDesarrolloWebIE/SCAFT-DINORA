<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('etapa1')->nullable();
            $table->double('etapa2')->nullable();
            $table->double('etapa3')->nullable();
            $table->date('date_etapa3')->nullable();
            $table->double('payment_one')->nullable();
            $table->double('etapa4')->nullable();
            $table->date('date_etapa4')->nullable();
            $table->double('etapa5')->nullable();
            $table->date('date_etapa5')->nullable();
            $table->double('etapa6')->nullable();
            $table->date('date_etapa6')->nullable();
            $table->double('payment_two')->nullable();
            $table->double('liquidez')->nullable();
            $table->date('final_date')->nullable();
            
            $table->unsignedBigInteger('service_quotation_id')->nullable();
            $table->foreign('service_quotation_id')->references('id')->on('services_quotations');
            $table->unsignedBigInteger('product_quotation_id')->nullable();
            $table->foreign('product_quotation_id')->references('id')->on('products_quotations');

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
        Schema::dropIfExists('progresses');
    }
}
