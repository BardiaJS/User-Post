<?php

namespace App\Http\Controllers;

use Response;
use Carbon\Carbon;
use App\Models\User;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\AddAvatarRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserPasswordUpdateRequest;


class UserController extends Controller
{
    // function for register the user

    public function register(UserStoreRequest $request){
        $token= request()->bearerToken();
        // if user has bearer token it means he logged in
        if($token){
            $is_super_admin = auth('sanctum')->user()->is_super_admin;
            $is_admin = auth('sanctum')->user()->is_admin;
            if($is_super_admin == true){
                $validated = $request->validated();
                User::create($validated);
                return redirect("/api/login");
            }else if($is_admin){
                $validated = $request->validated();
                $validated['is_admin'] = false;
                User::create($validated);
                return redirect("/api/login");
            }else{
                return redirect("/api/login");
            }
        }else{
                $validated = $request->validated();
                $validated['is_admin'] = false;
                User::create($validated);
                // new UserResource($user);
                return redirect("/api/login");
        }


    }

    // function for add the avatar
    // public function addAvatar(AddAvatarRequest $request , User $user){
    //     $token= request()->bearerToken();
    //     if($token){
    //         if(auth('sanctum')->user()->is_super_admin == true){
    //             $validated = $request->validated();
    //             $filName = time().$request->file('avatar')->getClientOriginalName();
    //             $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
    //             $validated ["avatar"] = '/storage/'. $path;
    //             $user->avatar = $validated['avatar'];
    //             $user->save();
    //             return  redirect('/api/login');
    //         }else if (auth('sanctum')->user()->is_admin == true){
    //             $filName = time().$addAvatarRequest->file('avatar')->getClientOriginalName();
    //             $path = $addAvatarRequest->file('avatar')->storeAs('avatars' , $filName , 'public');
    //             $requestData ["avatar"] = '/storage/'. $path;
    //             $validated = $addAvatarRequest->validated();
    //             $validated['avatar'] = $requestData["avatar"];
    //             $user -> update($validated);
    //             return  redirect('/api/login');
    //         }else{
    //             if(auth('sanctum')->user()->id == $user->id){
    //                 $filName = time().$addAvatarRequest->file('avatar')->getClientOriginalName();
    //                 $path = $addAvatarRequest->file('avatar')->storeAs('avatars' , $filName , 'public');
    //                 $requestData ["avatar"] = '/storage/'. $path;
    //                 $validated = $addAvatarRequest->validated();
    //                 $validated['avatar'] = $requestData["avatar"];
    //                 $user -> update($validated);
    //                 return  redirect('/api/login');
    //             }else{
    //                 abort(403 , "You can't set a profile to other users!");
    //             }
    //         }
    //     }else{
    //         $filName = time().$addAvatarRequest->file('avatar')->getClientOriginalName();
    //         $path = $addAvatarRequest->file('avatar')->storeAs('avatars' , $filName , 'public');
    //         $requestData ["avatar"] = '/storage/'. $path;
    //         $validated = $addAvatarRequest->validated();
    //         $validated['avatar'] = $requestData["avatar"];
    //         $user -> update($validated);
    //         return  redirect('/api/login');
    //     }

    // }

    // function fore login the user
    public function login(UserLoginRequest $request){
        $validated = $request->validated();
        if(!auth()->attempt($validated)){
            return redirect('/api/login-page');
        }else{
            // $request->session()->regenerate();
            $user = User::where('email', $validated['email'])->first();
            $user->last_entry = Carbon::now()->toDateString();
            $user->save();
            // $token = $user->createToken('api_token')->plainTextToken;
            return view('user.welcome-page');
        }







    }



    //show the user itself
    public function show(User $user){
            return new UserResource( $user );
    }


    //update the user data
    public function update(UserUpdateRequest $request, User $user){
            $is_super_admin = auth('sanctum')->user()->is_super_admin;
            $is_admin = auth('sanctum')->user()->is_admin;
            if($is_super_admin == true){
                $request['is_admin'] = 'required';
                $password = auth('sanctum')->user()->password;
                $validated = $request->validated();
                $validated['password'] = Hash::make('password');
                $user->update($validated);
                return new UserResource($user);
            }else if($is_admin){
                if($user->is_super_admin ==false and $user->is_admin == false){
                    $request['is_admin'] = 'required';
                    $password = auth('sanctum')->user()->password;
                    $validated = $request->validated();
                    $validated['password'] = Hash::make('password');
                    $user->update($validated);
                    return new UserResource($user);
                }
            }else{
                if(auth('sanctum')->user()->id == $user->id){
                    $password = auth('sanctum')->user()->password;
                    $validated = $request->validated();
                    $validated['password'] = Hash::make($password);
                    $validated['is_admin'] = false;
                    $user->update($validated);
                    return new UserResource($user);
                }else{
                    abort (403 , "You don't have an access");
                }
            }
    }

    // //show the profile
    // public function profile(){
    //     $token
    //     if()
    //         $user = Auth::user();
    //         if((bool)$user == true){
    //             return new UserResource( $user );
    //         }
    //         abort(403 , "no founding the user");
    // }

    public function changePassword(UserPasswordUpdateRequest $request , User $user){

        $is_super_admin = auth('sanctum')->user()->is_super_admin;
        $is_admin = auth('sanctum')->user()->is_admin;
        if($is_super_admin == true or $is_admin == true){
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['new_password']);
            $user->update($validated);
            return new UserResource($user);
        }else{
            if(auth('sanctum')->user()->id == $user->id){

                $validated = $request->validated();
                $isCheck =(bool) $validated['password'] == Auth::user()->password;
                if($isCheck){
                    $validated['password'] = Hash::make($validated['new_password']);
                    $user->update($validated);
                    return new UserResource($user);
                }
            }else{
                abort (403 , "You don't have an access");
            }
        }

    }

    public function index(){
        $user = Auth::user();

        if(($user->is_super_admin == true) || ($user->is_admin == true)){
            return new UserCollection(User::paginate());
        }else{
            abort(403 , 'You cannot get access to this page');
        }
    }


    public function updateAvatar(UpdateAvatarRequest $request , User $user){
        $is_super_admin = Auth::user()->is_super_admin;
        $is_admin = Auth::user()->is_admin;
        if($is_super_admin){
            $validated = $request->validated();
            $filName = time().$request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
            $oldAvatar = $user->avatar;
            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
            $validated ["avatar"] = '/storage/'. $path;
            $user->avatar = $validated['avatar'];
            $user->update();
        }else if($is_admin){
            if($user->id == Auth::user()->id){
                $validated = $request->validated();
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $oldAvatar = $user->avatar;
                Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                $validated ["avatar"] = '/storage/'. $path;
                $user->avatar = $validated['avatar'];
                $user->update();
            }else if($user->is_super_admin == false and $user->is_admin == false){
                $validated = $request->validated();
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $oldAvatar = $user->avatar;
                Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                $validated ["avatar"] = '/storage/'. $path;
                $user->avatar = $validated['avatar'];
                $user->update();
            }else{
                abort(403 , "You can't edit other admins and super_admin's avatar!");
            }
        }else{
            if(Auth::user()->id == $user-> id){
                $validated = $request->validated();
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $oldAvatar = $user->avatar;
                Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                $validated ["avatar"] = '/storage/'. $path;
                $user->avatar = $validated['avatar'];
                $user->update();
            }else{
                abort(403 , "You don't have permission to do that!!");
            }
        }

    }

    //sign out the user
    public function signout(){
        auth()->logout();
        return redirect('/api');
    }









}
