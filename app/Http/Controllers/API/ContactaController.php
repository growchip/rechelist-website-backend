<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Botble\Page\Models\Page;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactaController extends Controller
{
public function caddress()
{
    // Use SlugHelper to get page by slug
    $slug = SlugHelper::getSlug('contact', SlugHelper::getPrefix(Page::class));

    if (!$slug) {
        return response()->json([
            'status' => 'error',
            'message' => 'Contact page not found'
        ], 404);
    }

    // Fetch the page using the reference id
    $contactPage = Page::find($slug->reference_id);

    // Fetch custom fields
    $data = [
        'registered_office' => get_field($contactPage, 'r_office'),
        'admin_office'      => get_field($contactPage, 'admin_office'),
        'contact_info'      => get_field($contactPage, 'contact_info'),
    ];

    return response()->json([
        'status' => 'success',
        'data' => $data
    ]);
}



public function aboutsection()
{
    // Use SlugHelper to get page by slug
    $slug = SlugHelper::getSlug('about-us', SlugHelper::getPrefix(Page::class));

    if (!$slug) {
        return response()->json([
            'status' => 'error',
            'message' => 'About page not found'
        ], 404);
    }

    // Fetch the page using the reference id
    $aboutPage = Page::find($slug->reference_id);

    // Fetch custom fields
    $data = [
        'our_vision' => get_field($aboutPage, 'our_vision'),
        'our_mission'      => get_field($aboutPage, 'our_mission'),
        'innovation_in_pharma'      => get_field($aboutPage, 'innovation_in_pharma'),
         'global_presence_expansion'      => get_field($aboutPage, 'global_presence_expansion'),
          'growth_future_readiness'      => get_field($aboutPage, 'growth_future_readiness'),
          'quality_of_primary_health_care'      => get_field($aboutPage, 'quality_of_primary_health_care'),
           'uncompromised_quality'      => get_field($aboutPage, 'uncompromised_quality'),
            'customer_patient_centric_approach'      => get_field($aboutPage, 'customer_patient_centric_approach'),
            'team_specialists'      => get_field($aboutPage, 'team_specialists'), 
             'pharma_team'      => get_field($aboutPage, 'pharma_team'),
    ];

    return response()->json([
        'status' => 'success',
        'data' => $data
    ]);
}

}

    