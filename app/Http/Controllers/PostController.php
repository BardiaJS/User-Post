<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddThumbnailRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateThumbnailRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->is_super_admin == 1){
            return new PostCollection(Post::paginate());
        }else if(Auth::user()->is_admin == 1){
            
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request){
        $validated = $request->validated();
        $post = Post::create($validated);
        $post->user_id = Auth::user()->id;
        $post->save();
        return new PostResource($post);
    }


    public function addThumbnail(AddThumbnailRequest $request , Post $post){
        if(Auth::user()->is_super_admin == 1){
            $filName = time().$request->file('avatar')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
            $requestData ["thumbnail"] = '/storage/'. $path;
            $validated = $request->validated();
            $validated['thumbnail'] = $requestData["thumbnail"];
            $post -> update($validated);
            return new PostResource($post);
        }else if (Auth::user()->is_admin == 1){
            $filName = time().$request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
            $requestData ["thumbnail"] = '/storage/'. $path;
            $validated = $request->validated();
            $validated['thumbnail'] = $requestData["thumbnail"];
            $post -> update($validated);
            return new PostResource($post);
        }else{
            if(Auth::user()->id == $post->id){
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $requestData ["thumbnail"] = '/storage/'. $path;
                $validated = $request->validated();
                $validated['thumbnail'] = $requestData["thumbnail"];
                $post -> update($validated);
                return new PostResource($post);
            }else{
                abort(403 , "You can't set a profile to other users!");
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(Auth::user()->is_super_admin == 1){
            $validated = $request->validated();
            $post->update($validated);
        }else if(Auth::user()->is_admin == 1){
            if($post->user_id = Auth::user()->id){
                $validated = $request->validated();
                $post->update($validated);
            }else{
                if($post->user->is_admin != 0 and $post->user->is_super_admin != 0){
                    $validated = $request->validated();
                    $post->update($validated);
                }else{
                    abort(403 , "You can't edit super_admin or other admins post!");
                }
            }
        }else{
            if(Auth::user()->id == $post->user_id){
                $validated = $request->validated();
                $post->update($validated);
            }else{
                abort(403 , "You can't edit other users post!");
            }
        }
    }

    public function changeThumbnail(UpdateThumbnailRequest $request , Post $post){
        $is_super_admin = Auth::user()->is_super_admin;
        $is_admin = Auth::user()->is_admin;
        if($is_super_admin){
            $validated = $request->validated();
            $filName = time().$request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
            $oldThumbnail = $post->thumbnail;
            Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
            $validated ["thumbnail"] = '/storage/'. $path;
            $post->thumbnail = $validated['thumbnail'];
            $post->update();
        }else if($is_admin){
            if($post->user_id == Auth::user()->id){
                $validated = $request->validated();
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $oldThumbnail = $post->thumbnail;
                Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
                $validated ["thumbnail"] = '/storage/'. $path;
                $post->thumbnail = $validated['thumbnail'];
                $post->update();
            }else if($post->user->is_super_admin == 0 and $post->user->is_admin == 0){
                $validated = $request->validated();
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $oldThumbnail = $post->thumbnail;
                Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
                $validated ["thumbnail"] = '/storage/'. $path;
                $post->thumbnail = $validated['thumbnail'];
                $post->update();
            }else{
                abort(403 , "You can't edit other admins and super_admin's thumbnail!");
            }
        }else{
            if(Auth::user()->id == $post-> user_id){
                $validated = $request->validated();
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $oldThumbnail = $post->avatar;
                Storage::delete(str_replace("/storage/" , "public/" , $oldThumbnail));
                $validated ["avatar"] = '/storage/'. $path;
                $post->avatar = $validated['avatar'];
                $post->update();
            }else{
                abort(403 , "You don't have permission to do that!!");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post){

        if((Auth::user()->is_super_admin == 1)){
            $post->delete();
            return response()->noContent();
        }else if (Auth::user()->is_admin == 1){
            if(($post->user_id == Auth::user()->id) || (($post->user->is_admin == 0) and ($post->user->is_super_admin == 0))){
                $post->delete();
                return response()->noContent();
            }else{
                abort(403 , "You can't delete other admins or super_admin's posts!");
            }
        }else{
            if($post->user_id == Auth::user()->id){
                $post->delete();
                return response()->noContent();
            }else{
                abort(403 , "You can't delete other users posts!");
            }
        }
    }
}
