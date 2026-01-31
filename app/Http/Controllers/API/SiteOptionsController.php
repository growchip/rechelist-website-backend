<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteOptionsController extends Controller
{
    public function pcdFranchise(Request $request)
    {
        // Use theme_option helper to read values (Botble helper)
        $title = theme_option('pcd_title');
        $content = theme_option('pcd_content');

        // Offer list is stored as newline-separated string in your options
        $rawOffers = theme_option('pcd_offer_list');
        $offers = $this->parseOfferList($rawOffers);

        // Image: use RvMedia to get full URL (if image id is stored)
        $image = null;
        try {
            if ($mediaId = theme_option('pcd_image')) {
                if (function_exists('RvMedia')) {
                    $image = RvMedia::getImageUrl($mediaId);
                } else {
                    // if pcd_image already stores URL
                    $image = $mediaId;
                }
            }
        } catch (\Throwable $e) {
            $image = null;
        }
        
        $image2 = null;
try {
    if ($mediaId2 = theme_option('pcd_innerimage')) {
        if (function_exists('RvMedia')) {
            $image2 = RvMedia::getImageUrl($mediaId2);
        } else {
            $image2 = $mediaId2; // already a URL
        }
    }
} catch (\Throwable $e) {
    $image2 = null;
}

        return response()->json([
            'success' => true,
            'data' => [
                'id'      => theme_option('opt-pcd-franchise-section') ?? 'opt-pcd-franchise-section',
                'title'   => $title,
                'content' => $content,
                'offers'  => $offers,
                'image'   => $image,
                'innerimage'   => $image2,
            ],
            'message' => 'PCD Franchise section options retrieved'
        ]);
    }

    /**
     * Parses newline-separated list into an array, trimming items and removing empties.
     *
     * @param string|null $raw
     * @return array
     */
    protected function parseOfferList($raw)
    {
        if (! $raw) {
            return [];
        }

        // split by newline, support CRLF and LF
        $lines = preg_split('/\r\n|\r|\n/', $raw);

        return collect($lines)
            ->map(fn($l) => trim($l))
            ->filter(fn($l) => $l !== '' && $l !== '-' && $l !== '*')
            ->values()
            ->all();
    }
}
