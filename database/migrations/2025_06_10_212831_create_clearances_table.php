<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->enum('clearance_type', [
                'barangay_clearance',
                'business_clearance',
                'fencing_clearance',
                'indigency_clearance',
                'water_clearance',
                'electrical_clearance',
                'working_clearance'
            ])->default('barangay_clearance');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName');
            $table->string('provincialAddress');
            $table->unsignedTinyInteger('yearsInTagaytay');
            $table->string('presentAddress');
            $table->string('contactNumber', 20);
            $table->string('civilStatus');
            $table->string('citizenship');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->unsignedTinyInteger('age');
            $table->string('occupation');
            $table->string('companyName');
            $table->string('spouseName')->nullable();
            $table->string('spouseOccupation')->nullable();
            $table->string('fatherName');
            $table->string('fatherOccupation')->nullable();
            $table->string('motherName');
            $table->string('motherOccupation')->nullable();
            $table->string('validIdPath');
            $table->json('additional_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
