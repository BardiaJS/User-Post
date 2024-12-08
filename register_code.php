<?php
$uploadFolder = 'users';
if(Auth::check()){
    if((Auth::user() -> is_super_admin == 1)){
        if($request['is_admin'] != null ){
            if($request['avatar'] != null){
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $requestData ["avatar"] = '/storage/'. $path;
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['password']);
                $validated['avatar'] = $requestData["avatar"];
                $user = User::create($validated);
                return new UserResource($user);
            }

        }else{
            abort(403 , 'You are admin, you need to declare the user to be an admin or not!');
        }

    }else{
        abort(403 ,'You cannot create a user');
    }
}else{
    if($request['avatar'] != null){

        $filName = time().$request->file('avatar')->getClientOriginalName();
        $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
        $requestData ["avatar"] = '/storage/'. $path;
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['avatar'] = $requestData["avatar"];
        $user = User::create($validated);
        return new UserResource($user);
    }else{
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return new UserResource($user);
    }
}


?>
