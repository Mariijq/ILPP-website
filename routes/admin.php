<?php

use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ContactInfoController;
use App\Http\Controllers\Backend\ContactMessageController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\GalleryBackendController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\PublicationBackendController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\TestimonialsController;
use App\Http\Controllers\Backend\WhatWeDoController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// ==================== ADMIN AUTH ==================== //

Route::prefix('backend')->group(function () {

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])
        ->name('backend.login');

    Route::post('login', [AdminAuthController::class, 'login'])
        ->name('backend.login.submit');

    Route::post('logout', [AdminAuthController::class, 'logout'])
        ->name('backend.logout');

    Route::get('password/reset', [AdminAuthController::class, 'showForgotForm'])
        ->name('backend.password.request');

    Route::post('password/email', [AdminAuthController::class, 'sendResetLink'])
        ->name('backend.password.email');

    Route::get('password/reset/{token}', [AdminAuthController::class, 'showResetForm'])
        ->name('backend.password.reset');

    Route::post('password/reset', [AdminAuthController::class, 'resetPassword'])
        ->name('backend.password.update');
});

// ==================== ADMIN PANEL ==================== //

Route::prefix('backend')
    ->middleware([AdminAuth::class])
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('backend.dashboard');

        Route::resource('news', NewsController::class)
            ->names('backend.news');

        Route::resource('projects', ProjectController::class)
            ->names('backend.projects');

        Route::resource('publications', PublicationBackendController::class)
            ->names('backend.publications');

        Route::resource('team-members', TeamMemberController::class)
            ->names('backend.team-members');

        Route::resource('partners', PartnersController::class)
            ->names('backend.partners');

        Route::resource('documents', DocumentController::class)
            ->names('backend.documents');

        Route::resource('gallery', GalleryBackendController::class)
            ->names('backend.gallery');

        Route::resource('slides', SlideController::class)
            ->names('backend.slides');

        Route::resource('testimonials', TestimonialsController::class)
            ->names('backend.testimonials');

        Route::get('history', [HistoryController::class, 'edit'])
            ->name('backend.history.edit');
        Route::post('history', [HistoryController::class, 'updateOrCreate'])
            ->name('backend.history.update');

        Route::get('what-we-do', [WhatWeDoController::class, 'edit'])
            ->name('backend.what-we-do.index');
        Route::post('what-we-do', [WhatWeDoController::class, 'updateOrCreate'])
            ->name('backend.what-we-do.update');

        Route::get('contact-info', [ContactInfoController::class, 'index'])
            ->name('backend.contact-info.index');
        Route::post('contact-info', [ContactInfoController::class, 'update'])
            ->name('backend.contact-info.update');

        Route::get('about/edit', [AboutUsController::class, 'edit'])
            ->name('backend.about.edit');
        Route::post('about', [AboutUsController::class, 'updateOrCreate'])
            ->name('backend.about.update');

        Route::resource('contact-messages', ContactMessageController::class)
            ->names('backend.contact-messages');
    });
