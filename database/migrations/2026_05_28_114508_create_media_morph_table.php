<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_morph', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('media_id')->constrained('gallery_items')->cascadeOnDelete();
            $table->uuid('mediable_id');
            $table->string('mediable_type', 100);
            $table->string('role', 50)->default('cover');
            $table->timestamps();

            $table->index(['mediable_id', 'mediable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_morph');
    }
};
