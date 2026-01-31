<?php

use Botble\Base\Facades\AdminHelper;
use Botble\ProductType\Http\Controllers\ProducttypeController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'producttypes', 'as' => 'producttype.'], function () {
        Route::resource('', ProducttypeController::class)->parameters(['' => 'producttype']);
    });
});
