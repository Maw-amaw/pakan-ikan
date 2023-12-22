<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ph' => $this->ph,
            'suhu' => $this->suhu,
            'waktu' => $this->waktu,
        ];
    }
}
