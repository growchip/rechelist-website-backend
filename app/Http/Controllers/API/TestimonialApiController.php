<?php

namespace App\Http\Controllers\API;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Testimonials\Models\Testimonials;
use Illuminate\Http\JsonResponse;

class TestimonialApiController extends BaseController
{
    /**
     * Return all published testimonials as JSON.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $testimonials = Testimonials::where('status', 'published')
            ->select(['id', 'name', 'company', 'photo', 'message', 'created_at'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $testimonials,
        ]);
    }
}
