<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            "grpid" => $this->grpid,
            "name" => $this->name,
            "mobile_menus" => MobileMenuResource::collection($this->mobile_menus->sortBy('urutan')),
        ];
    }
}
