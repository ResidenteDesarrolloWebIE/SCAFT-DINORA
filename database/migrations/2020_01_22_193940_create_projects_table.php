<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio',12);
            $table->string('name', 500);
            $table->string('status',15);

            $table->unsignedBigInteger('product_quotation_id')->nullable();
            $table->foreign('product_quotation_id')->references('id')->on('products_quotations');
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
        Schema::dropIfExists('projects');
    }
}
