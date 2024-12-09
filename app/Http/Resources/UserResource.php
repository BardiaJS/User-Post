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
        $is_admin = 0;
        if($this->is_admin == true){
            $is_admin = 1;
        }else{
            $is_admin = 0;
        }

        return [
            'id'=> $this->id,
            'firstName' => $this->first_name,
            'lastName'=> $this->last_name,
            'displayName' => $this->display_name,
            'avatar'=> $this->avatar,
            'email'=> $this->email,
            'lastEntry' => $this->last_entry,
            'isAdmin' => $is_admin
        ];
    }
}
