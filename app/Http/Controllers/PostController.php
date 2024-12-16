<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        Post::create($validated);
        $id = Auth::user()->id;
        return redirect("/add-thumbnail-past/$id");
    }
}
