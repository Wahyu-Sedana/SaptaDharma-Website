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
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('subtitle')->nullable();

            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->string('icon')->nullable();

            $table->string('button_text')->nullable();

            $table->string('button_link')->nullable();

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
        Schema::dropIfExists('section_items');
    }
};
