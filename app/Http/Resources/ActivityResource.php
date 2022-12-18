<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description,
            'slug'          => $this->slug,
            'activity_type' => $this->activity_type,
            'content'       => $this->contents
        ];
    }
}
