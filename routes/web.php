<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseSubCategoryController;
use App\Http\Controllers\Admin\CourseController;

Route::as('front.')->group(function (){
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('about');
    Route::get('/contact-us', [FrontController::class, 'contactUs'])->name('contact');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('course-categories', CourseCategoryController::class);
    Route::resource('course-sub-categories', CourseSubCategoryController::class);
    Route::resource('courses', CourseController::class);

    Route::get('/approve-course/{id}', [CourseController::class, 'approveCourse'])->name('courses.approve');
    Route::post('/get-sub-category-by-category-id', [CourseController::class, 'getSubCategory'])->name('get-sub-category-by-category-id');
});
