<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\PublicationBackendController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\GalleryBackendController;
use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\WhatWeDoController;

use App\Http\Controllers\Frontend\WhoWeAreController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\PublicationsController;
use App\Http\Controllers\Frontend\GalleryController;


use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Auth; 

// ==================== CLIENT (PUBLIC SITE) ====================//

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [App\Http\Controllers\Frontend\NewsController::class, 'index'])->name('news');

Route::get('/news/{id}', [App\Http\Controllers\Frontend\NewsController ::class, 'show'])->name('news-details');

Route::prefix('who-we-are')->group(function () {
    Route::get('about', [WhoWeAreController::class, 'about'])->name('about');
    Route::get('history', [WhoWeAreController::class, 'history'])->name('history');
    Route::get('what-we-do', [WhoWeAreController::class, 'whatWeDo'])->name('what-we-do');
    Route::get('team', [WhoWeAreController::class, 'team'])->name('team');
    Route::get('partners', [WhoWeAreController::class, 'partners'])->name('partners');
    Route::get('internal-docs', [WhoWeAreController::class, 'internalDocs'])->name('internal-docs');
});

Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


// ==================== ADMIN (LOG IN) ====================//

Route::get('backend/login', [AdminAuthController::class, 'showLoginForm'])->name('backend.login');
Route::post('backend/login', [AdminAuthController::class, 'login'])->name('backend.login.submit');
Route::post('backend/logout', [AdminAuthController::class, 'logout'])->name('backend.logout');
Route::put('backend/password', [AdminAuthController::class, 'updatePassword'])->name('backend.password.update')->middleware(AdminAuth::class);


// ==================== ADMIN (PRIVATE SITE) ====================//

Route::prefix('backend')->middleware([AdminAuth::class])->group(function () {

        // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('backend.dashboard');

        // News Management
    Route::resource('news', NewsController::class);

    // Projects Management
    Route::resource('projects', ProjectController::class);

    // Publications Management
    Route::resource('publications', PublicationBackendController::class);

    // Team Members Management
    Route::resource('team-members', TeamMemberController::class);

    // Partners Management
    Route::resource('partners', PartnersController::class);

    Route::resource('documents', DocumentController::class);

    // Gallery Management
    Route::resource('gallery', GalleryBackendController::class);

    // About edit page
    Route::get('about', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::post('about', [AboutUsController::class, 'updateOrCreate'])->name('about.update');

    // History edit page
    Route::get('history', [HistoryController::class, 'edit'])->name('history.edit');
    Route::post('history', [HistoryController::class, 'updateOrCreate'])->name('history.update');
    Route::get('what-we-do', [WhatWeDoController::class, 'edit'])->name('what-we-do.index');
    Route::post('what-we-do', [WhatWeDoController::class, 'updateOrCreate'])->name('what-we-do.update');
    Route::get('partners', [PartnersController::class, 'index'])->name('partners.index');

});



