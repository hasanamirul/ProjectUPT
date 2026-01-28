<?php

use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/courses', [CourseController::class, 'apiIndex']);
    Route::get('/courses/search', [CourseController::class, 'apiSearch']);
});