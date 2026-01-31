<?php

namespace Botble\Blog\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Blog\Http\Resources\CategoryResource;
use Botble\Blog\Http\Resources\ListCategoryResource;
use Botble\Blog\Models\Category;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Supports\FilterCategory;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Http\Request;
use Botble\Base\Models\MetaBox;


class CategoryController extends BaseController
{
    /**
     * List categories
     *
     * @group Blog
     */
    public function index(Request $request)
    {
        $data = Category::query()
            ->wherePublished()
            ->orderByDesc('created_at')
            ->with(['slugable'])
            ->paginate($request->integer('per_page', 10) ?: 10);

        return $this
            ->httpResponse()
            ->setData(ListCategoryResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Filters categories
     *
     * @group Blog
     */
    public function getFilters(Request $request, CategoryInterface $categoryRepository)
    {
        $filters = FilterCategory::setFilters($request->input());
        $data = $categoryRepository->getFilters($filters);

        return $this
            ->httpResponse()
            ->setData(CategoryResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Get category by slug
     *
     * @group Blog
     * @queryParam slug Find by slug of category.
     */
    public function findBySlug(string $slug)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Category::class));

        if (! $slug) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage('Not found');
        }

        $category = Category::query()
            ->with('slugable')
            ->where([
                'id' => $slug->reference_id,
                'status' => BaseStatusEnum::PUBLISHED,
            ])
            ->first();

        if (! $category) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage('Not found');
        }

        return $this
            ->httpResponse()
            ->setData(new ListCategoryResource($category))
            ->toApiResponse();
    }
    
  public function posts(Request $request, $slug)
{
    $perPage = $request->query('per_page', 10); // default 10 per page

    $category = Category::with(['slugable'])
        ->whereHas('slugable', function ($query) use ($slug) {
            $query->where('key', $slug);
        })
        ->first();

    if (!$category) {
        return response()->json([
            'success' => false,
            'message' => 'Category not found',
        ], 404);
    }

    // Use query builder for posts (not collection)
    $postsQuery = $category->posts()
        ->with(['slugable', 'categories', 'tags', 'author'])
        ->latest();

    $posts = $postsQuery->paginate($perPage);

    // Transform posts
    $mappedPosts = $posts->map(function ($post) {
        return [
            'id'          => $post->id,
            'title'       => $post->name,
            'slug'        => $post->slug,
            'description' => $post->description,
            'content'     => $post->content,
            'image'       => $post->image,
            'author'      => $post->author->name ?? null,
            'created_at'  => $post->created_at,
        ];
    });

    // Prepare pagination data
    $pagination = [
        'current_page' => $posts->currentPage(),
        'last_page'    => $posts->lastPage(),
        'per_page'     => $posts->perPage(),
        'total'        => $posts->total(),
        'next_page_url'=> $posts->nextPageUrl(),
        'prev_page_url'=> $posts->previousPageUrl(),
    ];

    // Fetch SEO metadata
    $seo = [
        'title'       => $category->getMetaData('seo_title', true) ?? $category->name,
        'description' => $category->getMetaData('seo_description', true) ?? $category->description,
        'image'       => $category->getMetaData('seo_image', true) ?? $category->image,
    ];

    return response()->json([
        'success'  => true,
        'category' => [
            'id'   => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
        ],
        'seo'        => $seo,
        'posts'      => $mappedPosts,
        'meta' => $pagination,
    ], 200);
}



    
}
