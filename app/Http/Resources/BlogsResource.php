<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
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
            'content' => $this->content,
            'created_at' => $this->created_at,
            'id' => $this->id,
            'image' => asset('/storage/blogs/'.$this->image),
            'reflink' => $this->reflink,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }
}
