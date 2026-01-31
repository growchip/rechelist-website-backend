<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::resource('', ProductController::class)->parameters(['' => 'product']);
    });
});
