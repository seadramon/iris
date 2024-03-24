<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SignatureResource;

class FPerbaikanResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "no_inventaris"    => $this->no_inventaris,
            "inventory"        => [
                "nama"   => $this->inventory->uraian,
                "lokasi" => ($this->inventory->location->ket) ?? '',
            ],
            "kerusakan"        => $this->kerusakan,
            "penyebab"         => $this->penyebab,
            "penanganan"       => $this->penanganan,
            "waktu_kerusakan"  => $this->waktu_kerusakan,
            "kerusakan_path"   => $this->kerusakan_path,
            "kerusakan_url"    => !empty($this->kerusakan_path) ? full_url_from_path($this->kerusakan_path) : "",
            "prediksi_teknisi" => $this->prediksi_teknisi,
            "estimasi_teknisi" => $this->estimasi_teknisi,
            "perbaikan"        => $this->perbaikan,
            "suku_cadang"      => ($this->usedMaterials != null) ? UsedMaterialResource::collection($this->usedMaterials) : [],
            "catatan"          => $this->catatan,
            "perbaikan_mulai"  => $this->perbaikan_mulai,
            "perbaikan_selesai"=> $this->perbaikan_selesai,
            "mengganggu"       => $this->mengganggu,
            "perbaikan_path"   => $this->perbaikan_path,
            "perbaikan_url"    => !empty($this->perbaikan_path)?full_url_from_path($this->perbaikan_path):"",
            "status"           => $this->status,
            "created_at"       => $this->created_at,
            "updated_at"       => $this->updated_at,
            "sign"             => SignatureResource::collection($this->signatures),
        ];
    }
}
