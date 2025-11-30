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
            $table->text('welcome')->nullable();
            $table->text('our_journey')->nullable();
            $table->text('hspolicy')->nullable();
            $table->text('vision')->nullable();
            $table->text('commitment')->nullable();
            $table->text('whychooseus')->nullable();
            $table->text('welcome_ar')->nullable();
            $table->text('our_journey_ar')->nullable();
            $table->text('hspolicy_ar')->nullable();
            $table->text('vision_ar')->nullable();
            $table->text('commitment_ar')->nullable();
            $table->text('whychooseus_ar')->nullable();
            $table->string('image')->nullable();
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
