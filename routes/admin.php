<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\ContactInfoController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\GalleryBackendController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\PublicationBackendController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\WhatWeDoController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

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
    // History edit page
    Route::get('history', [HistoryController::class, 'edit'])->name('history.edit');
    Route::post('history', [HistoryController::class, 'updateOrCreate'])->name('history.update');
    Route::get('what-we-do', [WhatWeDoController::class, 'edit'])->name('what-we-do.index');
    Route::post('what-we-do', [WhatWeDoController::class, 'updateOrCreate'])->name('what-we-do.update');

    Route::get('partners', [PartnersController::class, 'index'])->name('partners.index');
    Route::get('contact-info', [ContactInfoController::class, 'index'])->name('contact-info.index'); // show form
    Route::post('contact-info', [ContactInfoController::class, 'update'])->name('contact-info.update'); // save form
    Route::get('about/edit', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::post('about', [AboutUsController::class, 'update'])->name('about.update');

});
