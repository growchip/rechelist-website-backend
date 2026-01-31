<?php

namespace Botble\Blog\Http\Resources;

use Botble\Blog\Models\Post;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class ListPostResource extends JsonResource
{
   public function toArray($request): array
{
    return [
        'id'          => $this->id,
        'name'        => $this->name,
        'slug'        => $this->slug,
        'description' => $this->description,
        'image'       => $this->image ? basename($this->image) : null,
        null,  // only filename
        'categories'  => CategoryResource::collection($this->categories),
        'tags'        => TagResource::collection($this->tags),
        'author'      => $this->author ? $this->author->name : null,
        'created_at'  => $this->created_at,
        'updated_at'  => $this->updated_at,
    ];
}

}
