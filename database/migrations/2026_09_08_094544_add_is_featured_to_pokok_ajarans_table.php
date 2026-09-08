<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('slug');
        });

        // Preserve current homepage behaviour: whichever group is already
        // slugged "wewarah-tujuh" keeps showing on the homepage by default.
        DB::table('pokok_ajarans')
            ->where('slug', 'wewarah-tujuh')
            ->update(['is_featured' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
