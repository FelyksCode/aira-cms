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
        Schema::create('feature_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_feature_id')->constrained('ai_features')->onDelete('cascade');
            $table->foreignId('cancer_id')->constrained('cancers')->onDelete('cascade');
            $table->string('key', 50);
            $table->string('label', 50);
            $table->boolean('require_csv');
            $table->boolean('require_img');
            $table->string('ai_model_name', 120);
            $table->string('ai_data_type', 20);
            $table->string('sample_dataset_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_options');
    }
};
