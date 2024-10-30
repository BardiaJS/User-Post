<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;

class UserController extends Controller
{
    // function for register the user

    public function register(UserStoreRequest $request){
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return new UserResource($user);
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
        // $entered_pass = $validated->input('password');
        if(!empty($request['is_admin'])){
            if(Auth::user()->is_super_admin == 1){
                if(!empty($request['email'])){
                    $gmailCheck = Auth::user()->gmail == $request['email'];
                    if($gmailCheck){
                        $validated = $request->validated();
                        $user->update($validated);
                        return new UserResource( $user );
                    }else{
                        abort(403,"You are not able to change the other users profile!");
                    }
                }else{
                    $validated = $request->validated();
                    $user->update($validated);
                    return new UserResource( $user );
                }
            }else{
                abort(403,"You are not allowed to do that!!");
            }
        }else{
            $validated = $request->validated();
            $user->update($validated);
            return new UserResource( $user );
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
    }
}
