<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('subtitle')->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('subtitle')->nullable()->change();
            $table->json('description')->nullable()->change();
            $table->json('button_text')->nullable()->change();
        });

        Schema::table('section_items', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->nullable()->change();
        });

        Schema::table('article_categories', function (Blueprint $table) {
            $table->json('name')->change();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
        });

        Schema::table('book_categories', function (Blueprint $table) {
            $table->json('name')->change();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->nullable()->change();
        });

        Schema::table('luhur_values', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->change();
        });

        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->json('title')->change();
        });

        Schema::table('pokok_ajaran_items', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->change();
            $table->json('quote')->nullable()->change();
        });

        Schema::table('founders', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('position')->change();
            $table->json('description')->nullable()->change();
        });

        Schema::table('history_timelines', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->change();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->nullable()->change();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('address')->change();
        });
    }

    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('subtitle')->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('subtitle')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->string('button_text')->nullable()->change();
        });

        Schema::table('section_items', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('article_categories', function (Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('title')->change();
            $table->longText('content')->change();
        });

        Schema::table('book_categories', function (Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->string('title')->change();
            $table->longText('description')->nullable()->change();
        });

        Schema::table('luhur_values', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->change();
        });

        Schema::table('pokok_ajarans', function (Blueprint $table) {
            $table->string('title')->change();
        });

        Schema::table('pokok_ajaran_items', function (Blueprint $table) {
            $table->string('title')->change();
            $table->longText('description')->change();
            $table->longText('quote')->nullable()->change();
        });

        Schema::table('founders', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('position')->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('history_timelines', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->change();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('address')->change();
        });
    }
};
