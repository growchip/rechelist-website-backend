<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ThemeLogoOptionsController extends Controller
{
    public function getLogoOptions(): JsonResponse
{
   
    $faviconPath = theme_option('favicon');
    $logoPath = theme_option('logo');
    $logoDescription = theme_option('logo_description');

    return response()->json([
        'favicon'          => basename($faviconPath),  
        'logo'             => basename($logoPath),     
        'logo_description' => $logoDescription,
    ]);
}

}
