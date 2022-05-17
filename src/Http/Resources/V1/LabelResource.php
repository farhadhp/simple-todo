<?php

namespace Farhadhp\SimpleTodo\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'tasks_count' => $this->tasks_count
        ];
    }
}
