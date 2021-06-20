<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
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
        Schema::dropIfExists('clients');
    }
}
