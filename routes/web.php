<?php

use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\PublicationsController;
use App\Http\Controllers\Frontend\WhoWeAreController;
use Illuminate\Support\Facades\Route;

// ==================== CLIENT (PUBLIC SITE) ====================//

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news-details');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::prefix('who-we-are')->group(function () {
    Route::get('about', [WhoWeAreController::class, 'about'])->name('about');
    Route::get('history', [WhoWeAreController::class, 'history'])->name('history');
    Route::get('what-we-do', [WhoWeAreController::class, 'whatWeDo'])->name('what-we-do');
    Route::get('team', [WhoWeAreController::class, 'team'])->name('team');
    Route::get('partners', [WhoWeAreController::class, 'partners'])->name('partners');
    Route::get('internal-docs', [WhoWeAreController::class, 'internalDocs'])->name('internal-docs');
});



