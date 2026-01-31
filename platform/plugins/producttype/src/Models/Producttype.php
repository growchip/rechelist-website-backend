<?php

namespace Botble\ProductType\Models;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Product\Models\Product;

class Producttype extends BaseModel
{
    protected $table = 'producttypes';

    protected $fillable = [
        'title', 'slug', 'desc', 'short_desc', 'image',
        'status','seo_title',
    'seo_description',
    'seo_image',
    'banner_image',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'title' => SafeContent::class,
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
