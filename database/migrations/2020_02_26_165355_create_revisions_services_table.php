<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('revision');
            $table->double('utility_percentage');
            $table->double('exchange_rate')->nullable();
            $table->double('overhead')->nullable();
            $table->double('sales_cost')->nullable();
            $table->double('financial_cost')->nullable();
            $table->integer('months')->nullable();
            $table->double('final_amount')->nullable();
            $table->double('total_amount');
            $table->integer('duration');
            $table->date('revision_date')->nullable();

            $table->unsignedBigInteger('cat_coin_id')->nullable();
            $table->foreign('cat_coin_id')->references('id')->on('cat_coins');
            $table->unsignedBigInteger('service_quotation_id')->nullable();
            $table->foreign('service_quotation_id')->references('id')->on('services_quotations');

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
        Schema::dropIfExists('revisions_services');
    }
}
