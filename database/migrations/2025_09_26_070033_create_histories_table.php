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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->json('input');
            $table->unsignedBigInteger('ai_feture_options_id');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('timestamp');
            $table->json('results');
            $table->foreign('ai_feture_options_id')->references('id')->on('feature_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
