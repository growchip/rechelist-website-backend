<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use RvMedia;

class WhyUsApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'subtitle' => theme_option('whyus_subtitle'),
            'title'    => theme_option('whyus_title'),
            'map_image' => basename(theme_option('whyus_map_image')), // only filename, or use RvMedia::getImageUrl() if full URL

            'features' => [
                [
                    'icon'        => theme_option('whyus_feature1_icon'),
                    'title'       => theme_option('whyus_feature1_title'),
                    'description' => theme_option('whyus_feature1_desc'),
                ],
                [
                    'icon'        => theme_option('whyus_feature2_icon'),
                    'title'       => theme_option('whyus_feature2_title'),
                    'description' => theme_option('whyus_feature2_desc'),
                ],
                [
                    'icon'        => theme_option('whyus_feature3_icon'),
                    'title'       => theme_option('whyus_feature3_title'),
                    'description' => theme_option('whyus_feature3_desc'),
                ],
            ],
        ]);
    }
}
