<?php

use Illuminate\Support\Facades\Route;
use ModernMcGuire\Headstart\Http\Controllers\PageController;

Route::get('/{page}', [PageController::class ,'show'])->name('page.show');
