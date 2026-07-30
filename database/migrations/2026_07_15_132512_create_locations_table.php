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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('image')->nullable();

            $table->text('address');

            $table->string('phone')->nullable();

            $table->decimal('latitude', 10, 8)->nullable();

            $table->decimal('longitude', 11, 8)->nullable();

            $table->text('maps_link')->nullable();

            $table->time('open_time')->nullable();

            $table->time('close_time')->nullable();

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
        Schema::dropIfExists('locations');
    }
};
