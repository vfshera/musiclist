<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DrumkitsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
         'id'  => $this->id,
         'title'  => $this->title,
         'about'  => $this->about,
         'image'  =>  asset('/storage/drumkits/covers/'.$this->image),
         'sample' =>  asset('/storage/drumkits/samples/'.$this->sample),
         'price' =>  ($this->price > 0 ) ? '$'.$this->price : 'FREE',
         'isFree' =>  ($this->price == 0 ) ? true : false,
        ];
    }
}
