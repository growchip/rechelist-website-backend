<?php

namespace Botble\Testimonials\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Testimonials extends BaseModel
{
    protected $table = 'testimonials';

    protected $fillable = [
        'name',
        'company',
        'photo',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'company' => SafeContent::class,
        'message' => SafeContent::class,
    ];
}
