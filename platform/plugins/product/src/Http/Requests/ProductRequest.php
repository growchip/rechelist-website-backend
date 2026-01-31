<?php

namespace Botble\Product\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:220'],
            'combination' => ['required'],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
