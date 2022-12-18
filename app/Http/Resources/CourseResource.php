<?php

namespace App\Http\Resources;

use App\Utils\Common\FilePaths;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'position'      => $this->position,
            'course_code'   => $this->course_code,
            'author_id'     => $this->author_id,
            'trainer_id'    => $this->trainer_id,
            'category_id'   => $this->category_id,
            'cover_image'   => $this->cover_image ? asset($this->cover_image) : asset(FilePaths::DEFAULT_COURSE_IMAGE),
            'is_active'     => $this->is_active,
            'status'        => $this->status,
        ];
    }
}
