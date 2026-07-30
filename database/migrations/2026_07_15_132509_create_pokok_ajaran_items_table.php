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
        Schema::create('pokok_ajaran_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pokok_ajaran_id')
                ->constrained('pokok_ajarans')
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('image')->nullable();

            $table->longText('description');

            $table->longText('quote')->nullable();

            $table->integer('sort_order')->default(0);

            $table->enum('status', ['draft', 'publish'])
                ->default('publish');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokok_ajaran_items');
    }
};
