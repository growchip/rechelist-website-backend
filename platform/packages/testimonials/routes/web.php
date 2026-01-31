<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Testimonials\Http\Controllers\TestimonialsController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'testimonials', 'as' => 'testimonials.'], function () {
        Route::resource('', TestimonialsController::class)->parameters(['' => 'testimonials']);
    });
});
