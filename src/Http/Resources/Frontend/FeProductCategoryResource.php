<?php

namespace AcitJazz\ProductCatalog\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class FeProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'color' => $this->color,
            'text_color' => $this->text_color,
            'summary' => $this->summary,
            'description' => $this->description,
            'image' => $this->image,
            'meta'=> $this->meta ?? [
               'title' =>  '',
               'description' =>  '',
               'image' =>  '',
            ],
            'published_at' => $this->published_at ? Carbon::parse($this->published_at)->format('Y-m-d H:i') : null,
        ];
    }
}
