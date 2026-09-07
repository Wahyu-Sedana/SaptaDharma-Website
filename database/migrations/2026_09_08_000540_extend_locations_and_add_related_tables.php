<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->string('video')->nullable()->after('image');
            $table->string('tuntunan_name')->nullable()->after('maps_link');
            $table->string('tuntunan_photo')->nullable()->after('tuntunan_name');
        });

        Schema::create('location_photos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnDelete();

            $table->string('photo');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });

        Schema::create('location_hours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnDelete();

            // 0 = Minggu ... 6 = Sabtu, matching Carbon's dayOfWeek.
            $table->unsignedTinyInteger('day');
            $table->boolean('is_closed')->default(false);
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();

            $table->timestamps();

            $table->unique(['location_id', 'day']);
        });

        Schema::create('location_activities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnDelete();

            $table->string('photo')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);

            $table->enum('status', ['draft', 'publish'])
                ->default('publish');

            $table->timestamps();
        });

        // Backfill slug + a default weekly schedule from the old single
        // open_time/close_time columns before those columns are dropped.
        foreach (DB::table('locations')->get() as $location) {
            $name = json_decode($location->name, true);
            $name = is_array($name) ? ($name['id'] ?? reset($name)) : $location->name;

            $slug = Str::slug($name) ?: 'sanggar-' . $location->id;
            $originalSlug = $slug;
            $suffix = 1;

            while (DB::table('locations')->where('slug', $slug)->where('id', '!=', $location->id)->exists()) {
                $suffix++;
                $slug = $originalSlug . '-' . $suffix;
            }

            DB::table('locations')->where('id', $location->id)->update(['slug' => $slug]);

            for ($day = 0; $day <= 6; $day++) {
                DB::table('location_hours')->insert([
                    'location_id' => $location->id,
                    'day' => $day,
                    'is_closed' => false,
                    'open_time' => $location->open_time,
                    'close_time' => $location->close_time,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->dropColumn(['open_time', 'close_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
        });

        Schema::dropIfExists('location_activities');
        Schema::dropIfExists('location_hours');
        Schema::dropIfExists('location_photos');

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['slug', 'video', 'tuntunan_name', 'tuntunan_photo']);
        });
    }
};
