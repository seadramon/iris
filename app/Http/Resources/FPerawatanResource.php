<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SignatureResource;

class FPerawatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"                => $this->id,
            "no_inventaris"     => $this->no_inventaris,
            "inventory"         => [
                "nama"   => $this ->inventory->uraian,
                "lokasi" => ($this->inventory->location->ket) ?? '',
            ],
            "pemeriksaan"       => $this->pemeriksaan,
            "pemeriksaan_hasil" => $this->pemeriksaan_hasil,
            "penanganan"        => $this->penanganan,
            "suku_cadang"       => ($this->usedMaterials != null) ? UsedMaterialResource::collection($this->usedMaterials) : [],
            "catatan"           => $this->catatan,
            "status"            => $this->status,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
            "sign"              => SignatureResource::collection($this->signatures)
        ];
    }
}
