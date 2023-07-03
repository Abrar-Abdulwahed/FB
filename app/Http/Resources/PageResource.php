<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=> $this->title,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'content'=> $this->content,
            'image'=> $this->image,
            'is_in_footer'=> $this->is_in_footer,
            'is_in_menu'=> $this->is_in_menu,
            'created at'=> $this->created_at->diffForHumans(),
        ];
    }
}
