<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::resource('', CategoryController::class)->parameters(['' => 'category']);
    });
});
