<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/history', function () {
    return view('pages.history');
})->name('history');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/publications', function () {
    return view('pages.publications');
})->name('publications');

Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::get('/what-we-do', function () {
    return view('pages.who_we_are');
})->name('what-we-do');
Route::get('/team', function () {
    return view('pages.team');
})->name('team');
Route::get('/partners', function () {
    return view('pages.partners');
})->name('partners');

Route::get('/internal-docs', function () {
    return view('pages.internal-docs');
})->name('internal-docs');

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

