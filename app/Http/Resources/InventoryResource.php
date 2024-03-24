<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CategoryResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($request->has('search')){
            return [
                'no_inventaris' => $this->no_inventaris,
                'uraian' => $this->uraian
            ];
        }else{
            return parent::toArray($request);
        }
    }
}
