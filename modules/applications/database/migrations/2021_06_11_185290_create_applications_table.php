<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->unsignedBigInteger('status');

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('nationality');
            $table->string('citizenship');
            $table->string('national_id');
            $table->string('gender');
            $table->dateTime('dob');

            $table->string('mobile_number');
            $table->string('home_number')->nullable();
            $table->string('work_number')->nullable();
            $table->string('email');
            $table->string('fax')->nullable();

            $table->text('physical_address_street');
            $table->text('physical_address_city');
            $table->text('physical_address_surburb');
            $table->text('physical_address_postcode');
            $table->boolean('postal_equal_to_physical')->default(false);

            $table->string('postal_address_street')->nullable();
            $table->string('postal_address_city')->nullable();
            $table->string('postal_address_surburb')->nullable();
            $table->string('postal_address_postcode')->nullable();

            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_email')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->text('next_of_kin_address')->nullable();

            $table->string('employment_status')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('employer_email')->nullable();
            $table->text('employer_address')->nullable();
            $table->decimal('gross_salary',20,2)->nullable();

            $table->integer('dependants')->nullable();
            $table->text('reason_for_moving')->nullable();
            $table->boolean('is_smoker')->default(false);
            $table->boolean('has_pets')->default(false);

            $table->json('references')->nullable();
            $table->json('expenses')->nullable();
            $table->json('next_of_kin')->nullable();
//            $table->dateTime('available_from');
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
        Schema::dropIfExists('applications');
    }
}
