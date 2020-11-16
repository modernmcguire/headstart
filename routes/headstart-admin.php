<?php

use Illuminate\Support\Facades\Route;
use ModernMcGuire\Headstart\Http\Controllers\PageController;
use ModernMcGuire\Headstart\Http\Controllers\Admin\FormController;
use ModernMcGuire\Headstart\Http\Controllers\Admin\MediaController;
use ModernMcGuire\Headstart\Http\Controllers\Admin\ResourceController;
use ModernMcGuire\Headstart\Http\Controllers\Admin\DashboardController;
use ModernMcGuire\Headstart\Http\Controllers\Admin\PageController as AdminPageController;



// Administration

Route::get('/', [DashboardController::class, 'show'])->name('dashboard.show');
Route::get('/media', [MediaController::class, 'show'])->name('media.show');

// Standard Pages
Route::prefix('/pages')->group(function() {
    Route::get('/', [AdminPageController::class, 'list'])->name('page.list');
    Route::get('/create', [AdminPageController::class, 'create'])->name('page.create');
    Route::get('/editor/{page}', [AdminPageController::class, 'edit'])->name('page.edit');
    Route::post('/editor/{page}', [AdminPageController::class, 'store'])->name('page.store');
    Route::get('/delete/{page}', [AdminPageController::class, 'destroy'])->name('page.destroy');
});

// Custom Resources
Route::prefix('/resources')->group(function() {
    Route::get('/{resource_type}', [ResourceController::class, 'list'])->name('resource.list');
    Route::get('/{resource_type}/create', [ResourceController::class, 'create'])->name('resource.create');
    Route::get('/{resource_type}/editor/{entity}', [ResourceController::class, 'edit'])->name('resource.edit');
    Route::post('/{resource_type}/editor/{entity}', [ResourceController::class, 'store'])->name('resource.store');
    Route::get('/{resource_type}/destroy/{entity}', [ResourceController::class, 'destroy'])->name('resource.destroy');
});

// Form submissions
Route::get('/form-submissions', [FormController::class, 'allSubmissions'])->name('forms.allSubmissions');
Route::resource('/forms', 'FormController');
Route::get('/forms/{form}/submissions', [FormController::class, 'showSubmissions'])->name('forms.show.submissions');
Route::get('/forms/{form}/submissions/{submission}', [FormController::class, 'showSubmission'])->name('forms.show.submission');
