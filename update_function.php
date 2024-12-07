<?php

        // $entered_pass = $validated->input('password');
        if(!empty($request['password'])){
            abort(403 , "You can't change the password from here!");
        }else{
            if(Auth::user()->is_super_admin == 1){
                if(Auth::user() == $user){
                    if(($request['is_admin'] == 0) && ($request['is_super_admiin'] == 0)){
                        abort(403 , "You can not change the 'is_admin' field to zero ! You are super_admin!!!");
                    }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }
                }else{

                        if($user->email == $request['email']){
                            $validated = $request->validated();
                            $user->email = $validated['email'];
                            $user->update($validated);
                            return new UserResource( $user );
                        }else{
                            $validated = $request->validated();
                            $user->update($validated);
                            return new UserResource( $user );
                        }


                }

            }else if(Auth::user()->is_admin == 1){
                if(!empty($request['is_admin'])){
                    if($user->email == $request['email']){
                        if($request['avatar'] != null){
                            $filName = time().$request->file('avatar')->getClientOriginalName();
                            $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                            $oldAvatar = $user->avatar;
                            Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                            $requestData ["avatar"] = '/storage/'. $path;
                            $validated = $request->validated();
                            $user->email = $validated['email'];
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
                                $user->email = $validated['email'];
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
                    abort(403 , "You can't change the super admin field for a user!");
                }
            }else{
                if(empty($request['is_admin'])){
                    if(Auth::user() == $user){
                        if(!empty($request['email'])){
                            if($user->email == $request['email']){
                                if($request['avatar'] != null){
                                    $filName = time().$request->file('avatar')->getClientOriginalName();
                                    $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                                    $oldAvatar = $user->avatar;
                                    Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                                    $requestData ["avatar"] = '/storage/'. $path;
                                    $validated = $request->validated();
                                    $user->email = $validated['email'];
                                    $validated["avatar"] = $requestData["avatar"];
                                    $user->update($validated);
                                    return new UserResource( $user );
                                }else{
                                    $validated = $request->validated();
                                    $user->update($validated);
                                    return new UserResource( $user );
                                }

                            }else{
                                if($request["avatar"] != null){
                                    $filName = time().$request->file('avatar')->getClientOriginalName();
                                    $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                                    $oldAvatar = $user->avatar;
                                    Storage::delete(str_replace("/storage/" , "public/" , $oldAvatar));
                                    $requestData ["avatar"] = '/storage/'. $path;
                                    $validated = $request->validated();
                                    $validated["avatar"] = $requestData["avatar"];
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
                        abort(403 , "you can't change other users profile!");
                    }
                }else{
                    abort(403 , "You can't change the admin field for a user!");
                }
            }
        }
?>
