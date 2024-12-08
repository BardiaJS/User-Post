<?php

namespace App\Http\Controllers;

use Response;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserPasswordUpdateRequest;
use Tests\Unit\UserTest;


class UserController extends Controller
{
    // function for register the user

    public function register(UserStoreRequest $request){
        if(Auth::check()){
            if(Auth::user()->is_super_admin == 1){
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['password']);
                $user = User::create($validated);
                return new UserResource($user);
            }else if(Auth::user()->is_admin == 1){
                if(empty($request['is-admin']) || empty($request['is_super_admin'])){
                    $validated = $request->validated();
                    $validated['password'] = Hash::make($validated['password']);
                    $user = User::create($validated);
                    return new UserResource($user);
                }else{
                    abort(403 , "You cannot set a user as a admin! You don't have permission to do that!");
                }
            }else{
                abort(403 , "You are a user, You cannot register a user");
            }
        }else{
            if(empty($request['is-admin']) || empty($request['is_super_admin'])){
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['password']);
                $user = User::create($validated);
                return new UserResource($user);
            }else{
                abort(403 , "You cannot set a user as a admin! You don't have permission to do that!");
            }
        }
    }

    // function fore login the user
    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email' ,
            'password' => 'required'
        ]);

        if(! Auth::attempt($validated)){
            return response()->json([
                'message' => 'login information is incorrect!'
            ] , 401)  ;
        }
            $user = User::where('email', $validated['email'])->first();
            $user->last_entry = Carbon::now()->toDateString();
            $user->save();
            return response()->json([
                'access_token' => $user->createToken('api_token')->plainTextToken ,
                'type_token' => 'Bearer'
            ]) ;

    }



    //show the user itself
    public function show(User $user){

            return new UserResource( $user );
    }


    //update the user data
    public function update(UserUpdateRequest $request, User $user){
        if(!empty($request['password'])){
            abort(403 , "You can't change the password from here!");
        }else{
            if(Auth::user()->is_super_admin == 1){
                if(Auth::user()->id == $user->id){
                    if(($request['is_super_admin'] == 0) || ($request['is_admin'] == 0)){
                        abort(403 , "You can not change the 'is_admin' field to zero ! You are super_admin!!!");
                    }else{
                        if($request['avatar'] != null){
                            $filName = time().$request->file('avatar')->getClientOriginalName();
                            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                            $oldAvatar = $user->avatar;
                            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                            $requestData ["avatar"] = '/storage/'. $path;
                            $validated = $request->validated();
                            // $user->email = $validated['email'];
                            $validated["avatar"] = $requestData['avatar'];
                            $user->update($validated);

                            return new UserResource( $user );
                        }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }
                    }
                }else{
                    if($request['avatar'] != null){
                        $filName = time().$request->file('avatar')->getClientOriginalName();
                        $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                        $oldAvatar = $user->avatar;
                        Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                        $requestData ["avatar"] = '/storage/'. $path;
                        $validated = $request->validated();
                        $validated["avatar"] = $requestData['avatar'];
                        $user->update($validated);
                        return new UserResource( $user );
                    }else{
                        $validated = $request->validated();
                        $user->update($validated);
                        return new UserResource( $user );
                    }
                }
            }else if(Auth::user()->is_admin == 1){
                // admin editing
                if(!empty($request['is_super_admin']) || !empty($request['is_admin'])){
                    abort(403 , "You don't have access to edit this part");
                }else{
                    if(Auth::user()->id == $user->id){
                        if($request['avatar'] != null){
                            $filName = time().$request->file('avatar')->getClientOriginalName();
                            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                            $oldAvatar = $user->avatar;
                            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                            $requestData ["avatar"] = '/storage/'. $path;
                            $validated = $request->validated();
                            $validated["avatar"] = $requestData['avatar'];
                            $user->update($validated);
                            return new UserResource( $user );
                        }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }

                    }else{
                        if($request['avatar'] != null){
                            $filName = time().$request->file('avatar')->getClientOriginalName();
                            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                            $oldAvatar = $user->avatar;
                            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                            $requestData ["avatar"] = '/storage/'. $path;
                            $validated = $request->validated();
                            // $user->email = $validated['email'];
                            $validated["avatar"] = $requestData['avatar'];
                            $user->update($validated);
                            return new UserResource( $user );
                        }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }
                    }
                }
            }else{
                if(!empty($request['is_super_admin']) || !empty($request['is_admin'])){
                    abort(403 , "You don't have access to edit this part");
                }else{
                    if(Auth::user()->id == $user->id){
                        if($request['avatar'] != null){
                            $filName = time().$request->file('avatar')->getClientOriginalName();
                            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                            $oldAvatar = $user->avatar;
                            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                            $requestData ["avatar"] = '/storage/'. $path;
                            $validated = $request->validated();
                            $validated["avatar"] = $requestData['avatar'];
                            $user->update($validated);
                            return new UserResource( $user );
                        }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }
                    }else{
                        abort(403 , "You are a normall user! You don't have access to edit this part");
                    }
                }
            }
        }
    }

    //show the profile
    public function profile(){
            $user = Auth::user();
            if((bool)$user == true){
                return new UserResource( $user );
            }
            abort(403 , "no founding the user");
    }

    public function changePassword(UserPasswordUpdateRequest $request){
            $validated = $request->validated();
            $isCheck =(bool) $validated['password'] == Auth::user()->password;
            if($isCheck){
                $validated['password'] = Hash::make($validated['password']);
                $validated['password'] = $validated['new_password'];
                $user = User::where('email' , Auth::user()->email)->first();
                $user->update($validated);
                return new UserResource( $user );
            }




    }

    public function index(){
        $user = Auth::user();

        if(($user->is_super_admin == 1) || ($user->is_admin == 1)){
            return new UserCollection(User::paginate());
        }else{
            abort(403 , 'You cannot get access to this page');
        }

        // $user = new UserTest();
    }





}
