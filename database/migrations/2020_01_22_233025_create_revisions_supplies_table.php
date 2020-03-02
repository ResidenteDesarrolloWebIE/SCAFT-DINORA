<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions_supplies', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('revision_number');
            $table->double('utility_percentage');
            $table->double('exchage_rate')->nullable();
            $table->double('final_amount');
            $table->timestamp('revision_date');
            $table->string('notes');

            $table->unsignedBigInteger('cat_coin_id')->nullable();
            $table->foreign('cat_coin_id')->references('id')->on('cat_coins');
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
        Schema::dropIfExists('revisions_supplies');
    }
}
