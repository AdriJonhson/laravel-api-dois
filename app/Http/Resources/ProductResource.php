<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductResource extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
            'slug'  => $this->slug,
            'price' => $this->price,
            'amount'=> $this->amount,
            'category'  => $this->category->title,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y')
        ];
    }
}
