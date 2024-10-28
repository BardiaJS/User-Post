<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // use of explode

        $string_array_tags = [];
        $string_array_tags[] = $request['tags'];



        return [
            'name' => $this->name,
            'content' => $this->content ,
            'tags' => $string_array_tags,
            'isVisible' =>$this->is_visible,
            'user_id' => $this->user->id
        ];
    }
}
