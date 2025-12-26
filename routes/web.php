<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ContactMessageController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\PublicationsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\TestimonialsController;
use App\Http\Controllers\Frontend\WhoWeAreController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// ==================== FRONTEND (PUBLIC SITE) ==================== //

Route::get('/', [HomeController::class, 'index'])->name('home');

// ---------- Language switch ----------
Route::get('lang/{locale}', [LanguageController::class, 'switch'])
    ->whereIn('locale', ['en', 'mk', 'al'])
    ->name('switch.lang');

// ---------- News ----------
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news');
    Route::get('{id}', [NewsController::class, 'show'])
        ->whereNumber('id')
        ->name('news-details');
});

// ---------- Projects ----------
Route::prefix('projects')->group(function () {
    Route::get('current', [ProjectsController::class, 'current'])->name('projects.current');
    Route::get('completed', [ProjectsController::class, 'completed'])->name('projects.completed');
    Route::get('{id}', [ProjectsController::class, 'show'])
        ->whereNumber('id')
        ->name('project-details');
});

// ---------- Publications ----------
Route::prefix('publications')->group(function () {
    Route::get('/', [PublicationsController::class, 'index'])->name('publications');
    Route::get('{id}', [PublicationsController::class, 'show'])
        ->whereNumber('id')
        ->name('publication-details');
    Route::get('{id}/download', [PublicationsController::class, 'download'])
        ->whereNumber('id')
        ->name('publications.download');
    Route::get('{id}/open', [PublicationsController::class, 'open'])
        ->whereNumber('id')
        ->name('publications.open');
});

// ---------- Gallery ----------
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// ---------- Voices ----------
Route::get('/voices', [TestimonialsController::class, 'index'])->name('voices');

// ---------- Contact ----------
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/contact-messages', [ContactMessageController::class, 'create'])
    ->name('contact.messages.create');
Route::post('/contact-messages', [ContactMessageController::class, 'store'])
    ->name('contact.messages.store');

// ---------- Search ----------
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ---------- Who we are ----------
Route::prefix('who-we-are')->group(function () {
    Route::get('about', [WhoWeAreController::class, 'about'])->name('about');
    Route::get('history', [WhoWeAreController::class, 'history'])->name('history');
    Route::get('what-we-do', [WhoWeAreController::class, 'whatWeDo'])->name('what-we-do');
    Route::get('team', [WhoWeAreController::class, 'team'])->name('team');
    Route::get('partners', [WhoWeAreController::class, 'partners'])->name('partners');
    Route::get('supporters', [WhoWeAreController::class, 'supporters'])->name('supporters');
    Route::get('documents', [WhoWeAreController::class, 'documents'])->name('documents');
});
