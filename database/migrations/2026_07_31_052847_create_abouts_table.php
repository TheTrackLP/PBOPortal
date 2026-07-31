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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('mission_title')->nullable();
            $table->string('mission_content')->nullable();
            $table->string('vision_title')->nullable();
            $table->string('vision_content')->nullable();
            $table->string('org_outcome_title')->nullable();
            $table->string('org_outcome_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
