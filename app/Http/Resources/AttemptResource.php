<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttemptResource extends JsonResource
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
            'id'       => $this->id,
            'question' => $this->question->only('id','name'),
            'quiz'     => $this->quiz->only('id','name','duration','start_date','end_date'),
            'answers'  => $this->question->answers()->select('id','name')->get()->shuffle()
        ];
    }
}
