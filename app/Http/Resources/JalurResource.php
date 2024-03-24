<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JalurResource extends JsonResource
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
            "kode_pat" => $this->kode_pat,
            "kd_jalur" => $this->jalur,
            "nama" => $this->pat->ket . ' (Jalur '. $this->jalur .')',
        ];
    }
}
