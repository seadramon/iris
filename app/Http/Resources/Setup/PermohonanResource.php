<?php

namespace App\Http\Resources\Setup;

use Illuminate\Http\Resources\Json\JsonResource;

class PermohonanResource extends JsonResource
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
            "kd_jalur" => $this->kd_jalur,
            "kd_pat" => $this->kd_pat,
            "kd_cetakan" => $this->kd_cetakan,
            "nama_cetakan" => $this->cetakan->ket ?? '',
            "tgl_pemakaian" => $this->tgl_pemakaian,
        ];
    }
}
