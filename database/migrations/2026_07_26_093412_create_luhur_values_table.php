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
        Schema::create('luhur_values', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->text('description');

            $table->string('icon')->nullable();

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
        Schema::dropIfExists('luhur_values');
    }
};
