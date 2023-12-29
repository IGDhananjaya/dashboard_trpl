<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatkulResource extends JsonResource
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
            'id' => $this->mk_id,
            'mk_kode' => $this->mk_kode,
            'mk_nama'=>$this->mk_nama,
            'semester'=>$this->semester,
            'sks'=>$this->sks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
