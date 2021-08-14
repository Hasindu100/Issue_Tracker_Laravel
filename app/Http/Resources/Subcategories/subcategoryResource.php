<?php

namespace App\Http\Resources\Subcategories;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Categories\CategoryResource;

class subcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'category_id' => CategoryResource::collectio($this->category_id)->first()->id,
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
