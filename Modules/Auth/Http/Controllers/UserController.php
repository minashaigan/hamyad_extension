<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        if($user = auth()->user()){
            $favorites = $user->favorites()->get();
            
            $user_courses = $user->courses()->get();
            
        }
        else{
            return view('auth::profile')->withErrors('Unauthorized');
        }
    }
}