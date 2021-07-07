<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->decimal('rental_price',20,2)->nullable();
            $table->decimal('area',20,2)->nullable();
            $table->text('description')->nullable();
            $table->text('physical_address_street');
            $table->text('physical_address_city');
            $table->text('physical_address_surburb');
            $table->text('physical_address_postcode');
            $table->boolean('postal_equal_to_physical')->default(false);
            $table->text('postal_address_street')->nullable();
            $table->text('postal_address_city')->nullable();
            $table->text('postal_address_surburb')->nullable();
            $table->text('postal_address_postcode')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('properties');
    }
}
