<?php

namespace AcitJazz\ProductCatalog\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class FeProductResource extends JsonResource
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
            'summary' => $this->summary,
            'description' => $this->description,
            'qty' => [
                'value' => $this->qty,
                'formatted' => number_format($this->price, 2, '.', ','),
            ],
            'price' => [
                'value' => $this->price,
                'currency' => 'Rp. ',
                'formatted' => number_format($this->price, 2, '.', ','),
            ],
            'categories' => ListCategoryResource::collection($this->categories)->resolve(),
            'galleries' => $this->galleries,
            'meta'=> $this->meta ?? [
               'title' =>  '',
               'description' =>  '',
               'image' =>  '',
            ],
            'published_at' => $this->published_at ? Carbon::parse($this->published_at)->format('Y-m-d H:i') : null,
        ];
    }
}
