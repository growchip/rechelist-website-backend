<?php

namespace Botble\Product\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Category\Models\Category;
use Botble\ProductType\Models\Producttype;

class Product extends BaseModel
{
    protected $table = 'products';

    protected $fillable = [
        'type_id', 'title', 'desc', 'brand_name', 'combination', 'image', 'pack', 'mrp', 'status', 'slug'
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        // apply SafeContent to title (not 'name' because your column is 'title')
        'title' => SafeContent::class,
    ];

    /**
     * Many-to-Many relation to categories.
     * Pivot table: product_category (columns: product_id, category_id)
     */
    public function categories()
    {
        return $this->belongsToMany(
            \Botble\Category\Models\Category::class,
            'product_category_product',
            'product_id',
            'product_category_id'
        );
    }


    public function type()
    {
        return $this->belongsTo(Producttype::class);
    }
}
