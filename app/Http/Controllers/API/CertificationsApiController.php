<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class CertificationsApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'title'       => theme_option('certifications_title'),
            'description' => theme_option('certifications_description'),
            'certifications' => [
                [
                    'image' => basename(theme_option('cert_image_1')),
                ],
                [
                    'image' => basename(theme_option('cert_image_2')),
                ],
                [
                    'image' => basename(theme_option('cert_image_3')),
                ],
            ],
        ]);
    }
}
