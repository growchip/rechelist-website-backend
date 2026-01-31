<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Botble\Category\Models\Category as CategoryProduct;
use Botble\Product\Models\Product;
use Botble\ProductType\Models\Producttype;
use Botble\Product\Models\ProductCategory;
use Illuminate\Support\Str;
use RvMedia;

class HomeController extends Controller
{
    
 public function productList(Request $request)
{
    $category = $request->query('category'); 
    $perPage = $request->query('per_page', 10); 

    $query = Product::with(['categories', 'type']);

    if ($category) {
        $query->whereHas('categories', function ($q) use ($category) {
            $q->where('title', $category); 
        });
    }

    $products = $query->paginate($perPage);

    if ($products->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No products found for that category'
        ], 404);
    }

    // Map product data
    $data = $products->getCollection()->transform(function ($product) {
        return [
            'id'           => $product->id,
            'title'        => $product->title,
            'slug'         => $product->slug,
            'combination'  => $product->combination,
            'pack'         => $product->pack,
            'mrp'          => $product->mrp,
            'image'        => $product->image,
            'type'         => $product->type ? $product->type->title : null,
        ];
    });

    // Add SEO & Banner data from theme options
    $allProducts = [
        'seo_title'       => theme_option('products_seo_title'),
        'seo_description' => theme_option('products_seo_description'),
        'seo_image'       => basename(theme_option('products_seo_image')) ? basename(theme_option('products_seo_image')) : null,
        'banner_image'    => basename(theme_option('products_banner_image')) ? basename(theme_option('products_banner_image')) : null,
    ];

    return response()->json([
        'success'       => true,
        'current_page'  => $products->currentPage(),
        'last_page'     => $products->lastPage(),
        'per_page'      => $products->perPage(),
        'total'         => $products->total(),
        'allproducts'   => $allProducts,
        'data' => $data,
        'message'       => 'Products retrieved successfully'
    ]);
}

    public function productListBySlug(Request $request, $slug)
{
    $category = CategoryProduct::where('slug', $slug)->first();

    if (! $category) {
        return response()->json([
            'success' => false,
            'message' => 'Category not found'
        ], 404);
    }

    $perPage = $request->query('per_page', 10);

    // Paginate products directly from the relationship
    $products = $category->products()
        ->with('type')
        ->paginate($perPage);

    if ($products->isEmpty()) {
        return response()->json([
            'success' => true,
            'message' => 'No products found for this category',
            'category' => [
                'id' => $category->id,
                'title' => $category->title,
                'slug' => $category->slug,
                'short_description' => $category->short_desc,
                'seo_title'=> $category->seo_title,
            'seo_description' => $category->seo_description,
            'seo_image' => $category->seo_image,
            'banner_image' => $category->banner_image,
            ],
            'current_page' => $products->currentPage(),
            'last_page'    => $products->lastPage(),
            'per_page'     => $products->perPage(),
            'total'        => $products->total(),
            'data' => []
        ], 200);
    }

    $productList = $products->map(function ($p) {
        return [
            'id'    => $p->id,
            'title' => $p->title,
            'combination' => $p->combination,
            'slug' => $p->slug,
            'pack' => $p->pack,
            'mrp'   => $p->mrp,
            'image' => $p->image,
            'type'  => $p->type ? $p->type->slug : null,
        ];
    })->values();

    return response()->json([
        'success'  => true,
        'category' => [
            'id'    => $category->id,
            'title' => $category->title,
            'short_description' => $category->short_desc,
            'slug'  => $category->slug,
            'seo_title'=> $category->seo_title,
            'seo_description' => $category->seo_description,
            'seo_image' => $category->seo_image,
            'banner_image' => $category->banner_image,
        ],
        'current_page' => $products->currentPage(),
        'last_page'    => $products->lastPage(),
        'per_page'     => $products->perPage(),
        'total'        => $products->total(),
        'data'     => $productList,
        'message'  => 'Products retrieved successfully'
    ]);
}




public function productListByTypeSlug(Request $request, $slug)
{
    $type = Producttype::where('slug', $slug)->first();

    if (! $type) {
        return response()->json([
            'success' => false,
            'message' => 'Product type not found'
        ], 404);
    }

    $perPage = $request->query('per_page', 10);

    // Paginate products directly
    $products = Product::where('type_id', $type->id)
        ->with('categories', 'type')
        ->paginate($perPage);

    if ($products->isEmpty()) {
        return response()->json([
            'success' => true,
            'message' => 'No products found for this product type',
            'type' => [
                'id' => $type->id,
                'title' => $type->title,
                'slug' => $type->slug,
                'short_description' => $type->short_desc,
                'seo_title'=> $type->seo_title,
            'seo_description' => $type->seo_description,
            'seo_image' => $type->seo_image,
            'banner_image' => $type->banner_image,
            ],
            'current_page' => $products->currentPage(),
            'last_page'    => $products->lastPage(),
            'per_page'     => $products->perPage(),
            'total'        => $products->total(),
            'data' => []
        ], 200);
    }

    $productList = $products->map(function ($p) {
        return [
            'id'          => $p->id,
            'title'       => $p->title,
            'slug'        => $p->slug,
            'combination' => $p->combination,
            'pack'        => $p->pack,
            'mrp'         => $p->mrp,
            'image'       => $p->image,
            'type'        => $p->type ? $p->type->slug : null,
        ];
    })->values();

    return response()->json([
        'success' => true,
        'type'    => [
            'id'    => $type->id,
            'title' => $type->title,
            'short_description' => $type->short_desc,
            'slug'  => $type->slug,
            'seo_title'=> $type->seo_title,
            'seo_description' => $type->seo_description,
            'seo_image' => $type->seo_image,
            'banner_image' => $type->banner_image,
        ],
        'current_page' => $products->currentPage(),
        'last_page'    => $products->lastPage(),
        'per_page'     => $products->perPage(),
        'total'        => $products->total(),
        'data'    => $productList,
        'message' => 'Products retrieved successfully'
    ]);
}


  public function categoryList()
{
    $categories = CategoryProduct::where('slug', '<>', 'featured')->get();

    if ($categories->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No categories found'
        ], 404);
    }

    // Remove SEO & banner fields
    $categories = $categories->map(function ($category) {
        return collect($category)->except([
            'seo_title',
            'seo_description',
            'seo_image',
            'banner_image'
        ]);
    });

    return response()->json([
        'success' => true,
        'data' => $categories,
        'message' => 'Categories retrieved successfully'
    ]);
}



      public function productTypeList()
    {
        $productTypeList = Producttype::get();
    
        if ($productTypeList->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No similar product-type found'
            ], 404);
        }
    
        // Remove unwanted fields but keep the same structure
        $productTypeList = $productTypeList->map(function ($type) {
            return collect($type)->except([
                'seo_title',
                'seo_description',
                'seo_image',
                'banner_image'
            ]);
        });
    
        return response()->json([
            'success' => true,
            'data' => $productTypeList,
            'message' => 'Product Types retrieved successfully'
        ]);
    }



public function productDetail($slug)
   {
       if(!$slug)
       {
          return response()->json([
                'success' => false,
                'message' => 'No Slug found'
            ], 404);
       }
       $product = Product::where('slug', $slug)->with(['categories', 'type'])->first();
       
       if(!$product){
          return response()->json([
                'success' => false,
                'message' => 'No similar product found'
            ], 404);
       }
       return response()->json([
            'success' => true,
            'data' => [
                'id'          => $product->id ?? '',
                'title'       => $product->title ?? '',
                'combination' => $product->combination ?? '',
                'brand_name'  => $product->brand_name ?? '',
                'pack'        => $product->pack ?? '',
                'mrp'         => $product->mrp ?? '',
                'image'       => $product->image ?? '', 
                'type_id'        => $product->type_id,
                'categories'  => $product->categories,
                'type'        => $product->type->title,
        ],
            'message' => 'Product retrieved successfully'
        ]);
   }
}
