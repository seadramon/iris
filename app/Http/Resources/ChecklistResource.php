<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $presonal = $this->personal;
        return [
            "created_by" => $presonal->pengguna,
            "no_inventaris" => $this->no_inventaris,
            "inventory" => [
                "nama"   => $this ->inventory->uraian,
                "lokasi" => ($this->inventory->location->ket) ?? '',
            ],
            "created_at" => date('d-m-Y', strtotime($this->created_at)),
            "detail" => ChecklistDetailResource::collection($this->detail)
        ];
    }
}
