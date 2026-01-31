<?php

namespace Botble\Product\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Category\Models\Category;
use Botble\Category\Models\Product;

class ProductCategory extends BaseModel
{
    protected $table = 'prod_category';

    protected $fillable = [
        'product_id',
        'product_category_id'
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        // 'title' => SafeContent::class,
    ];

   public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_category_product',
            'product_category_id',
            'product_id'
        );
    }
}
