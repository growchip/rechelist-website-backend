<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use RvMedia;

class MenuController extends Controller
{
    
   public function getAllMenus(): JsonResponse
{
    // Fetch the menus
    $menus = DB::table('menus')
        ->where('status', 'published')
        ->get();

    if (!$menus) {
        return response()->json([
            'message' => 'Menus not found',
        ], 404);
    }

    $menuItems = [];

    foreach ($menus as $menu) {
        $items = $this->getMenuNodes($menu->id, null);
        $menuItems[] = [
            'id' => $menu->id,
            'name' => $menu->name,
            'slug' => $menu->slug,
            'items' => $items,
        ];
    }

    $address = theme_option('address');
    $contactEmail = theme_option('contact_email');
    $contactNumber = theme_option('contact_number');

    return response()->json([
        'menus' => $menuItems,
        'contact' => [
            'address' => $address,
            'email' => $contactEmail,
            'phone' => $contactNumber,
        ],
    ]);
}


    /**
     * Fetch menu items by slug.
     */
    public function getMenuBySlug(string $slug): JsonResponse
{
    // First: find the slug entry in slugs table for menus
    $slugRow = DB::table('slugs')
        ->where('key', $slug)
        ->where('reference_type', 'Botble\Menu\Models\Menu')
        ->first();

    if (!$slugRow) {
        return response()->json([
            'message' => 'Menu slug not found',
        ], 404);
    }

    // Now fetch the menu using the reference_id
    $menu = DB::table('menus')
        ->where('id', $slugRow->reference_id)
        ->where('status', 'published')
        ->first();

    if (!$menu) {
        return response()->json([
            'message' => 'Menu not found',
        ], 404);
    }

    // Fetch menu items (your recursive call)
    $items = $this->getMenuNodes($menu->id, null);

    return response()->json([
        'menu' => $menu->name,
        'slug' => $slugRow->key,  // or $menu->slug if menu table has it
        'items' => $items,
    ]);
}


    /**
     * Recursive function to build menu node tree.
     */
    private function getMenuNodes(int $menuId): array
    {
        $nodes = DB::table('menu_nodes')
        ->where('menu_id', $menuId)
        ->where('parent_id', 0)
        ->orderBy('position')
        ->get();
        
        

        $result = [];

        foreach ($nodes as $node) {
            $result[] = [
                'id' => $node->id,
                'title' => $node->title,
                'url' => $node->url,
                'icon' => $node->icon_font,
                'target' => $node->target,
                'has_child' => $node->has_child,
                'children' => DB::table('menu_nodes')->where('menu_id', $menuId)->where('parent_id', $node->id)->orderBy('position')->get(['id','url','title','target','has_child']),
            ];
        }

        return $result;
    }
    
    
    
 public function getPageBySlug(string $slug): JsonResponse
{
    $slugRow = DB::table('slugs')->where('key', $slug)->first();

    if (!$slugRow) {
        return response()->json(['error' => 'Page not found'], 404);
    }

    $page = \Botble\Page\Models\Page::find($slugRow->reference_id);

    if (!$page) {
        return response()->json(['error' => 'Page not found'], 404);
    }

    // Get banner image filename
    $bannerImage = DB::table('meta_boxes')
        ->where('reference_id', $page->id)
        ->where('reference_type', 'Botble\\Page\\Models\\Page')
        ->where('meta_key', 'banner_image')
        ->value('meta_value');

    $bannerImageName = null;
    if ($bannerImage) {
        $decoded = json_decode($bannerImage, true);
        if (is_array($decoded)) {
            $bannerImageName = basename($decoded[0] ?? '');
        } else {
            $bannerImageName = basename($bannerImage);
        }
    }

    // Get SEO meta
    $seoMetaRaw = DB::table('meta_boxes')
        ->where('reference_id', $page->id)
        ->where('reference_type', 'Botble\\Page\\Models\\Page')
        ->where('meta_key', 'seo_meta')
        ->value('meta_value');

    $seoMeta = null;
    if ($seoMetaRaw) {
        $decodedSeo = json_decode($seoMetaRaw, true);

        if (is_array($decodedSeo)) {
            if (!isset($decodedSeo[0])) {
                $seoMeta = [
                    'seo_title' => $decodedSeo['seo_title'] ?? null,
                    'seo_description' => $decodedSeo['seo_description'] ?? null,
                    'seo_image' => !empty($decodedSeo['seo_image'])
                        ? basename(RvMedia::getImageUrl($decodedSeo['seo_image']))
                        : null,
                ];
            } elseif (isset($decodedSeo[0]['seo_title'])) {
                $seoMeta = [
                    'seo_title' => $decodedSeo[0]['seo_title'] ?? null,
                    'seo_description' => $decodedSeo[0]['seo_description'] ?? null,
                    'seo_image' => !empty($decodedSeo[0]['seo_image'])
                        ? basename(RvMedia::getImageUrl($decodedSeo[0]['seo_image']))
                        : null,
                ];
            }
        }
    }

    // Get gallery images
    $galleryImages = [];

    $galleryMetaRaw = DB::table('gallery_meta')
        ->where('reference_id', $page->id)
        ->where('reference_type', \Botble\Page\Models\Page::class)
        ->value('images');

    if ($galleryMetaRaw) {
        $decodedGallery = json_decode($galleryMetaRaw, true);

        if (is_array($decodedGallery)) {
            foreach ($decodedGallery as $item) {
                if (!empty($item['img'])) {
                    $galleryImages[] = basename($item['img']);
                }
            }
        }
    }

    return response()->json([
        'id' => $page->id,
        'name' => $page->name,
        'slug' => $slug,
        'content' => $page->content,
        'image' => $page->image,
        'description' => $page->description,
        'template' => $page->template,
        'banner' => $bannerImageName,
        'seo' => $seoMeta,
        'gallery' => $galleryImages, // ✅ fixed to return only image names
        'created_at' => $page->created_at,
    ]);
}


    
}
