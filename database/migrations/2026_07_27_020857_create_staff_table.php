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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name')->nullable();
            $table->string('staff_position')->nullable();
            $table->string('staff_designation')->nullable();
            $table->string('staff_photo')->nullable();
            $table->integer('order')->nullable();
            $table->integer('divisionid')->nullable();
            $table->tinyInteger('isActive')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
