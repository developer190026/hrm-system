<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Alldepartments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);

         return [
            'id'  => $this->id,
            'department_name'     => $this->department_name,
            'description' =>  $this->description
        ];
    }
}
