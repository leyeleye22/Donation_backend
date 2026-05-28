<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('theme');
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->json('location')->nullable();
            $table->json('beneficiary_label')->nullable();
            $table->bigInteger('goal_amount')->default(0);
            $table->bigInteger('collected_amount')->default(0);
            $table->string('status')->default('upcoming');
            $table->string('cover_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->foreignUuid('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
