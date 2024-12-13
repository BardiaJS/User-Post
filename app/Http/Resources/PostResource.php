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

        $is_visible = false;
        if($this->is_visible == true){
            $is_visible = true;
        }else{
            $is_visible = false;
        }


        return [
            'name' => $this->name,
            'content' => $this->content ,
            'tags' => $string_array_tags,
            'isVisible' =>$is_visible,
            'user_id' => $this->user->id
        ];
    }
}
