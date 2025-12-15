<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ContactMessageController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\PublicationsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\WhoWeAreController;
use App\Http\Controllers\LanguageController;

use Illuminate\Support\Facades\Route;

// ==================== CLIENT (PUBLIC SITE) ====================//

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news-details');

Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectsController::class, 'show'])->name('project-details');

Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/publications/{id}', [PublicationsController::class, 'show'])->name('publication-details');
Route::get('/publications/{id}/download', [PublicationsController::class, 'download'])->name('publications.download');
Route::get('/publications/{id}/open', [PublicationsController::class, 'open'])->name('publications.open');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/contact-messages', [ContactMessageController::class, 'create'])->name('contact.messages.create');
Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact.messages.store');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/news/{id}', [NewsController::class, 'show'])->name('news-details');
Route::get('/projects/{id}', [ProjectsController::class, 'show'])->name('project-details');
Route::get('/publications/{id}', [PublicationsController::class, 'show'])->name('publication-details');

Route::prefix('who-we-are')->group(function () {
    Route::get('about', [WhoWeAreController::class, 'about'])->name('about');
    Route::get('history', [WhoWeAreController::class, 'history'])->name('history');
    Route::get('what-we-do', [WhoWeAreController::class, 'whatWeDo'])->name('what-we-do');
    Route::get('team', [WhoWeAreController::class, 'team'])->name('team');
    Route::get('partners', [WhoWeAreController::class, 'partners'])->name('partners');
    Route::get('documents', [WhoWeAreController::class, 'documents'])->name('documents');

});
Route::get('lang/{locale}', [LanguageController::class, 'switch'])
    ->name('switch.lang');
