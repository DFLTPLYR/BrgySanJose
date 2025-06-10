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
        Schema::create('clerances', function (Blueprint $table) {
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
            $table->json('additional-data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clerances');
    }
};
