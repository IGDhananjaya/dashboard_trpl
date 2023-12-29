<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
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
            'dosen_id' => $this->dosen_id,
            'dosen_code' => $this->dosen_code,
            'name' => $this->name,
            'gender' => $this->gender,
            'skill' => $this->skill,
            'certified' => $this->certified,
            'nip' => $this->nip,
            'photo' => url('images/dosen/'.$this->photo),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
