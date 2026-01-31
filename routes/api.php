<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\TestimonialApiController;
use App\Http\Controllers\API\CertificationsApiController;
use App\Http\Controllers\API\WhyUsApiController;
use App\Http\Controllers\API\ThemeLogoOptionsController;
use App\Http\Controllers\API\ThemeDescriptionsController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\SiteOptionsController;
use App\Http\Controllers\API\AdminOfficeController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ContactaController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\FaqController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
Route::get('/products', [HomeController::class, 'productList']);
Route::get('/product-types', [HomeController::class, 'productTypeList']);
Route::get('/product-categories', [HomeController::class, 'categoryList']);
Route::get('/product/{slug}', [HomeController::class, 'productDetail']);
Route::get('menus', [MenusController::class, 'getAllMenus']);
Route::get('/menus', [MenuController::class, 'getAllMenus']);
Route::get('/menus/{slug}', [MenuController::class, 'getMenuBySlug']);
Route::get('testimonials', [TestimonialApiController::class, 'index']);
Route::get('pages/{slug}', [MenuController::class, 'getPageBySlug']);
Route::get('certifications', [CertificationsApiController::class, 'index']);
Route::get('why-us', [WhyUsApiController::class, 'index']);
Route::get('/theme-options/logo', [ThemeLogoOptionsController::class, 'getLogoOptions']);
Route::get('/site-desc', [ThemeDescriptionsController::class, 'getSitedOptions']);
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);
Route::post('/talktohr', [NewsletterController::class, 'talktohr']);
Route::get('products/{slug}', [HomeController::class, 'productListBySlug']);
Route::get('products/type/{slug}', [HomeController::class, 'productListByTypeSlug']);
Route::get('site-options/pcd-franchise', [SiteOptionsController::class, 'pcdFranchise']);
Route::get('/admin-office', [AdminOfficeController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/contactad', [ContactaController::class, 'caddress']);
Route::get('/aboutsection', [ContactaController::class, 'aboutsection']);
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/product/{slug}', [HomeController::class, 'productDetail']);

});



















