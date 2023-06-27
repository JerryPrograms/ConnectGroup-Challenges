<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Create the People table
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            // Add other people attributes
            $table->timestamps();
        });

        // Create the Company table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create the Locations table
        Schema::create('company_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            // Add other location attributes
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
        });

        // Create the Assets table
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            // Add other asset attributes
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
        });

        // Create the Managers table
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('person_id');
            // Add other manager attributes
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('person_id')->references('id')->on('people');
        });

        // Create the Employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('group_id')->nullable();
            // Add other employee attributes
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('group_id')->references('id')->on('company_groups');
        });

        // Create the Company Groups table
        Schema::create('company_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('head_employee_id')->nullable();
            // Add other company group attributes
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('head_employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        // Drop the tables in reverse order
        Schema::dropIfExists('company_groups');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('managers');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('people');
        Schema::dropIfExists('companies');
    }
};
