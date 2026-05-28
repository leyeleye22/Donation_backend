<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('site_name')->default('Entraide Humanitaire');
            $table->string('donation_cta_text')->default('Faire un don');
            $table->boolean('show_floating_button')->default(true);
            $table->json('floating_button_pages')->nullable();
            $table->text('footer_copyright')->nullable();
            $table->text('footer_intro')->nullable();
            $table->json('page_visibility')->nullable();
            $table->json('page_settings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_settings');
    }
};
