<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ThemeDescriptionsController extends Controller
{

public function getSitedOptions(): JsonResponse
{
   
    $siteTitle = theme_option('site_title');
    $siteDescription = theme_option('site_description');
    $bannerImage = setting('theme-ripple-default_breadcrumb_banner_image');
    $seo_title = setting('theme-ripple-seo_title');
    $seo_desc = setting('theme-ripple-seo_description');
    $seo_image = setting('theme-ripple-seo_og_image');
    

    return response()->json([
        'site_title' => $siteTitle,
        'site_description' => $siteDescription,
        'banner_image' =>$bannerImage,
        'seo_title' => $seo_title,
        'seo_description' => $seo_desc,
        'seo_image' => $seo_image
    ]);
}


}
