<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CategoryResource;

class InventoryDataResource extends JsonResource
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
            "no_inventaris" => $this->no_inventaris,
            "nama"   => $this->uraian,
            "lokasi" => ($this->location->ket) ?? '',
        ];
    }
}
