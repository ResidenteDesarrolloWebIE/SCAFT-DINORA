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
            $table->double('etapa1');
            $table->double('etapa2');
            $table->double('etapa3');
            $table->date('date_etapa3');
            $table->double('payment_one');
            $table->double('etapa4');
            $table->date('date_etapa4');
            $table->double('etapa5');
            $table->date('date_etapa5');
            $table->double('etapa6');
            $table->date('date_etapa6');
            $table->double('payment_two');
            $table->double('liquidez');
            $table->date('final_date');
            
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
