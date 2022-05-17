<?php

namespace Farhadhp\SimpleTodo\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'description' => $this->description,
            'status' => [
                'id' => $this->status,
                'title' => $this->status_title,
            ],
            'labels' => LabelResource::collection($this->whenLoaded('labels'))
        ];
    }
}
