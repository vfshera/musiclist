<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeatsResource extends JsonResource
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
            'id'  => $this->id,
            'title'  => $this->title,
            'tags'  => $this->tags,
            'cover'  =>  asset('/storage/beats/covers/'.$this->cover),
            'sample' =>  asset('/storage/beats/samples/'.$this->sample),
            'isPaid' =>  ($this->ispaid == 0 ) ? true : false,
        ];
    }
}
