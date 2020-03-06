<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio',20);
            $table->string('service_type',200);
            $table->text('description');
            $table->text('service_location');
            $table->date('estimated_time');
            $table->string('status',20);
            $table->text('notes')->nullable();
            $table->tinyInteger('bidding')->default(0)->nullable();
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');
            
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
        Schema::dropIfExists('services');
    }
}
