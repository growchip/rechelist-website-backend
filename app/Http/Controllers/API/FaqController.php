<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Botble\Page\Models\Page;
use Botble\Slug\Models\Slug;
use Botble\Base\Models\MetaBox;
use Botble\Slug\Facades\SlugHelper;

class FaqController extends Controller
{
    
 public function index()
{
    // Get slug for FAQ page
    $slug = SlugHelper::getSlug('faq', SlugHelper::getPrefix(Page::class));

    if (!$slug) {
        return response()->json([
            'status' => 'error',
            'message' => 'FAQ page not found',
        ], 404);
    }

    // Fetch page
    $faqPage = Page::find($slug->reference_id);

    // Assuming your repeater field name is `add_faq`
    $faqItems = get_field($faqPage, 'add_faq');

    $data = [];
    $id = 1; // Initialize FAQ ID

    if (!empty($faqItems) && is_array($faqItems)) {
        foreach ($faqItems as $item) {
            $faqData = [
                'title'   => '',
                'content' => ''
            ];

            foreach ($item as $field) {
                if ($field['slug'] === 'questions') {
                    $faqData['title'] = $field['value'];
                } elseif ($field['slug'] === 'answer') {
                    $faqData['content'] = $field['value'];
                }
            }

            $data[] = array_merge(['id' => $id], $faqData);
            $id++;
        }
    }

    return response()->json([
        'status' => 'success',
        'data'   => $data,
    ]);
}

}
