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
        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        foreach (DB::table('pokok_ajarans')->get() as $pokokAjaran) {
            $title = json_decode($pokokAjaran->title, true);
            $title = is_array($title) ? ($title['id'] ?? reset($title)) : $pokokAjaran->title;

            $slug = Str::slug($title) ?: 'pokok-ajaran-' . $pokokAjaran->id;
            $originalSlug = $slug;
            $suffix = 1;

            while (DB::table('pokok_ajarans')->where('slug', $slug)->where('id', '!=', $pokokAjaran->id)->exists()) {
                $suffix++;
                $slug = $originalSlug . '-' . $suffix;
            }

            DB::table('pokok_ajarans')->where('id', $pokokAjaran->id)->update(['slug' => $slug]);
        }

        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
