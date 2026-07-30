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
        Schema::create('pokok_ajarans', function (Blueprint $table) {
            $table->id();

            $table->string('title');

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
        Schema::dropIfExists('pokok_ajarans');
    }
};
