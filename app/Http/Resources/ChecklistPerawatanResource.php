<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistPerawatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $disabled = false;
        $message = '';

        $assign = $this->latest_assign;
        $now = strtotime(now());
        if(strtotime($assign->periode_awal) <= $now && strtotime(str_replace('00:00:00', '23:59:59', $assign->periode_akhir)) >= $now){
            $disabled = false;
        }else{
            $disabled = true;
            $message = 'Sudah Melewati atau Belum Masuk Periode ' . date('d-m-Y', strtotime($assign->periode_awal)) . ' s/d ' . date('d-m-Y', strtotime($assign->periode_akhir));
        }
        if($assign->checklist != null){
            $disabled = true;
            $message = 'Checklist Perawatan Sudah Dilakukan ';
        }
        return [
            "id" => $this->id,
            "nama" => $this->nama,
            "disabled" => $disabled,
            "message" => $message,
            "details" => ChecklistPerawatanDetailResource::collection($this->detail),
            "assign_id" => $this->latest_assign->id ?? null,
            "latest_perawatan" => new ChecklistResource($assign->checklist)
        ];
    }
}
