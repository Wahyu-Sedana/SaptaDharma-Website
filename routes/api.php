<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\TeachingController;
use Illuminate\Support\Facades\Route;

Route::get('/settings', [SettingsController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/teachings', [TeachingController::class, 'index']);

Route::get('/history', [HistoryController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/articles/{slug}', [ArticleController::class, 'show']);

Route::get('/books', [BookController::class, 'index']);

Route::get('/books/{slug}', [BookController::class, 'show']);

Route::get('/books/{slug}/download', [BookController::class, 'download']);

Route::get('/locations', [LocationController::class, 'index']);
