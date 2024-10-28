<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if((bool)$user){
            if (($user->is_admin == 1) || ($user->is_admin == 1)) {
                return new PostCollection(Post::paginate());
                }else {
                    $id = $user->id;
                    $posts = Post::where('user_id' , $id)->get();
                    foreach($posts as $post){
                        return new PostResource($post);
                    }
                }
        }else{
            $posts = Post::where('is_visible' , true)->get();
            foreach($posts as $post){
                return new PostResource($post);
            }
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated ['user_id'] = Auth::user()->id;
        $post = Post::create($validated );
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        return response()->json([
            'updated_data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if((Auth::user()->is_admin == 1) or (Auth::user()->is_super_admin == 1)){
            $post->delete();
            return response()->noContent();
        }else{
            abort(403,"You aren't able to do that!!");
        }
    }
}
