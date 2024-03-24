<?php

namespace App\Http\Resources\Setup;

use App\Http\Resources\InventoryDataResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SignatureResource;

class PemenuhanListResource extends JsonResource
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
            "id"=>$this->id,
            "setup_id"=>$this->setup_id,
            "permohonan"=> new PermohonanResource($this->setup_cetakan),
            "inventaris" => new InventoryDataResource($this->inventory),
            "tgl_selesai" => $this->tgl_selesai,
            "qa" => $this->qa,
            "keterangan" => $this->keterangan,
            "status" => $this->status,
            "sign" => SignatureResource::collection($this->signatures->sortBy('created_at')),
        ];
    }
}
