<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AddThumbnailRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $post = Post::create($validated);
        $post_id = $post->id;
        return redirect('/add-thumbnail-post'.$post_id);
    }

    public function addThumbnail(AddThumbnailRequest $request , Post $post){
        if(Auth::user()->is_super_admin == true){
            $requestData = $request->validated();
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $requestData ["thumbnail"] = '/storage/'. $path;
                $post->thumbnail = $requestData['thumbnail'];
                $post->save();
                return view ('test');
        }else if (Auth::user()->is_admin == true){
                $requestData = $request->validated();
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $requestData ["thumbnail"] = '/storage/'. $path;
                $post->thumbnail = $requestData['thumbnail'];
                $post->save();
                return view ('test');

        }else{
            if(Auth::user()->id == $post->id){
                $requestData = $request->validated();
                $filName = time().$request->file('thumbnail')->getClientOriginalName();
                $path = $request->file('thumbnail')->storeAs('thumbnails' , $filName , 'public');
                $requestData ["thumbnail"] = '/storage/'. $path;
                $post->thumbnail = $requestData['thumbnail'];
                $post->save();
                return view ('test');
            }else{
                return view ('false-test');
            }
        }
    }
}
