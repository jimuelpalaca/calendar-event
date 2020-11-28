<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => ucwords($this->name),
            'days' => json_decode($this->days),
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at
        ];
    }
}
