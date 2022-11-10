<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function allUser(){
        $user['data']= User::getUser();

       return view('admin/users', $user);
    }
    public function userStatus($user_id, $value){
        if($value=='yes'){
            DB::table('users')->where('id',$user_id)->update(['status'=>1]);
            return response()->json(['status'=>'User Activated']);
        }elseif($value=='no'){
            DB::table('users')->where('id',$user_id)->update(['status'=>0]);
            return response()->json(['status'=>'User Deactivated']);
        }
    }

}
