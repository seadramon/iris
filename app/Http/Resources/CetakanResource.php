<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CetakanResource extends JsonResource
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
            "kode" => $this->kd_cetakan,
            "nama" => $this->ket
        ];
    }
}
