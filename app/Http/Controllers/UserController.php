<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserPasswordUpdateRequest;

class UserController extends Controller
{
    public function register(UserStoreRequest $request){

            if(Auth::check()){
                if(Auth::user()->is_admin == true or Auth::user()->is_super_admin == true){
                    $validated = $request->validated();
                    $user = User::create($validated);
                    return redirect('/welcome-page')->with('message','You created an account successfully!');
                }
            }else{
                $validated = $request->validated();
                $user = User::create($validated);
                // auth()->login(  $user);
                return redirect('/login')->with('message','You created an account successfully!');

            }

    }

    public function login(request $request){
        $validated = $request->validate([
            'email' => 'required|email' ,
            'password' => 'required'
        ]);
        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('/welcome-page')->with('message' , 'You are logged in successfully');
        }else{
            return redirect('/')->with('failure' , 'Invalid data!');
        }
    }

    public function signout(){
        auth()->logout();
        return redirect('/');
    }


    public function changePassword(UserPasswordUpdateRequest $request , User $user){
        $is_super_admin = Auth::user()->is_super_admin;
        $is_admin = Auth::user()->is_admin;
        if($is_super_admin == true){
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['new_password']);
            $user->update($validated);
            return redirect('/welcome-page');
        }else if ($is_admin == true){
            if($user->is_admin == 0 and $user->is_super_admin == 0){
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['new_password']);
                $user->update($validated);
                return redirect('/welcome-page');
            }else{
                return redirect('/change-password-page');
            }
        }else{
            if(Auth::user()->id == $user->id){
                $validated = $request->validated();
                $isCheck =(bool) $validated['password'] == Auth::user()->password;
                if($isCheck){
                    $validated['password'] = Hash::make($validated['new_password']);
                    $user->update($validated);
                    return redirect('/welcome-page');
                }
            }else{
                return redirect('/change-password-page');
            }
        }
    }
}
