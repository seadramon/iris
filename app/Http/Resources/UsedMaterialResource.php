<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsedMaterialResource extends JsonResource
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
            "kd_material" => $this->kd_material,
            "nama"        => $this->material->uraian ?? '', 
            "spek"        => $this->material->spesifikasi ?? '', 
            "qty"         => $this->qty, 
            "satuan"      => $this->material->satuan ?? '', 
            "catatan"     => $this->catatan
        ];
    }
}