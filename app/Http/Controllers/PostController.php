<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

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
        if($request['thumbnail'] != null){
            $filName = time().$request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
            $requestData ["thumbnail"] = '/storage/'. $path;
            $validated = $request->validated();
            $validated ['user_id'] = Auth::user()->id;
            $validated['thumbnail'] = $requestData["thumbnail"];
            $post = Post::create($validated);
            return new PostResource($post);
        }else{
            $validated = $request->validated();
            $validated ['user_id'] = Auth::user()->id;
            $post = Post::create($validated);
            return new PostResource($post);
        }

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
            if((Auth::user()->is_admin == 1) || (Auth::user()->is_super_admin == 1)){
                $validated = $request->validated();

                    $filName = time().$request->file('thumbnail')->getClientOriginalName();
                    $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                    $oldThumbnail = $post->thumbnail;
                    Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
                    $requestData ["thumbnail"] = '/storage/'. $path;
                    $validated = $request->validated();
                    $validated["thumbnail"] = $requestData['thumbnail'];
                    $post->update($validated);
                    return new PostResource($post);




            }else{
                $isChecked = (bool) ($post->user_id == Auth::user()->id);
                if($isChecked){

                        $filName = time().$request->file('thumbnail')->getClientOriginalName();
                        $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                        $oldThumbnail = $post->thumbnail;
                        Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
                        $requestData ["thumbnail"] = '/storage/'. $path;
                        $validated = $request->validated();
                        $validated["thumbnail"] = $requestData['thumbnail'];
                        $post->update($validated);
                        return new PostResource($post);

                }else{
                    abort (403 , "the post isn't yours");
                }
            }
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
