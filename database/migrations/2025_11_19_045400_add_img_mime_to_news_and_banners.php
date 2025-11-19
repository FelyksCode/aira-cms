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
        Schema::table('news', function (Blueprint $table) {
            $table->longText('image_url')->charset('binary')->change();
            $table->string('image_mime')->nullable()->after('image_url');
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->longText('image_url')->charset('binary')->change();
            $table->string('image_mime')->nullable()->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->blob('image_url')->change();
            $table->dropColumn('image_mime');
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->blob('image_url')->change();
            $table->dropColumn('image_mime');
        });
    }
};
