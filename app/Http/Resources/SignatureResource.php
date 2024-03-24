<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SignatureResource extends JsonResource
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
            "id" => $this->id,
            "source_type"   => $this->source_type, 
            "source_id"     => $this->source_id, 
            "sign_by"       => $this->pic->first_name . ' ' . $this->pic->last_name,
            "signer"        => [
                'first_name' => $this->pic->first_name, 
                'last_name' => $this->pic->last_name
            ],
            "sign_path"     => $this->sign_path, 
            "sign_url"      => !empty($this->sign_path) ? full_url_from_path($this->sign_path) : full_url_from_path($this->sign_by),
            "created_at"    => $this->created_at, 
            "updated_at"    => $this->updated_at
        ];
    }
}