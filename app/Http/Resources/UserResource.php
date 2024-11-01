<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {

        return [
            'id'=> $this->id,
            'firstName' => $this->first_name,
            'lastName'=> $this->last_name,
            'displayName' => $this->display_name,
            'avatar'=> $this->avatar,
            'email'=> $this->email,
            'lastEntry' => $this->last_entry,
            'isAdmin' => $this->is_admin
        ];
    }
}
