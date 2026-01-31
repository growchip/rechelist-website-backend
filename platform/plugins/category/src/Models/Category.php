<?php

namespace Botble\Category\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Category extends BaseModel
{
    protected $table = 'prod_category';

    protected $fillable = [
        'title', 'slug', 'desc', 'short_desc', 'image', 'status', 'seo_title',
    'seo_description',
    'seo_image',
    'banner_image'
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'title' => SafeContent::class,
    ];

   public function products()
{
    return $this->belongsToMany(
        \Botble\Product\Models\Product::class, // ✅ correct namespace
        'product_category_product',             // pivot table
        'product_category_id',                  // foreign key on pivot for category
        'product_id'                             // foreign key on pivot for product
    );
}

}
