<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\WhatWeDoController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\InternalDocsController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Auth; 

// ==================== CLIENT (PUBLIC SITE) ====================//

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [FrontNewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [FrontNewsController::class, 'show'])->name('news.show');

Route::get('/what-we-do', [WhatWeDoController::class, 'index'])->name('what-we-do');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');



// Show login form
Route::get('backend/login', [AdminAuthController::class, 'showLoginForm'])->name('backend.login');
Route::post('backend/login', [AdminAuthController::class, 'login'])->name('backend.login.submit');
Route::post('backend/logout', [AdminAuthController::class, 'logout'])->name('backend.logout');
Route::put('backend/password', [AdminAuthController::class, 'updatePassword'])->name('backend.password.update')->middleware(AdminAuth::class);

// Admin dashboard protected routes
Route::prefix('backend')->middleware([AdminAuth::class])->group(function () {

        // Dashboard
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('backend.dashboard');

        // News Management
    Route::resource('news', NewsController::class);

    // Projects Management
    Route::resource('projects', ProjectController::class);

    // Publications Management
    Route::resource('publications', PublicationController::class);

    // Team Members Management
    Route::resource('team-members', TeamMemberController::class);

    // Gallery Management
    Route::resource('gallery', GalleryController::class);

    // About edit page
    Route::get('about', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::post('about', [AboutUsController::class, 'updateOrCreate'])->name('about.update');
    // History edit page
    Route::get('history', [HistoryController::class, 'edit'])->name('history.edit');
    Route::post('history', [HistoryController::class, 'updateOrCreate'])->name('history.update');
    Route::get('what-we-do', [WhatWeDoController::class, 'index'])->name('what-we-do.index');
    Route::get('partners', [PartnersController::class, 'index'])->name('partners.index');
    Route::get('internal-docs', [InternalDocsController::class, 'index'])->name('internal-docs.index');

});



