<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTFactory;
use Exception;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{

    // public function __construct(){
    // $this->middleware('auth:api', ['Except'=>['UserLogin']]);
    // }

    public function UserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_id' => 'required',
            'email' => 'required|string',
        ]);
        //$validator->errors()
        if($validator->fails()){
          return response()->json(["status"=>false,"message"=>"invalid input details","data"=>json_decode($validator->errors())]);
        }


        $social_id = $request->social_id;
        $user = User::where('social_id', '=', $social_id)->where('email', '=', $request->email)->first();
       if($user){
        try {
                  $myTTL = 43200; //minutes
               JWTAuth::factory()->setTTL($myTTL);

            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // if no errors are encountered we can return a JWT
        $user=JWTAuth::setToken($token)->toUser();

        return response()->json(["status"=>true,"token"=>$token,"data"=>$user]);

    }else{
        return response()->json(["status"=>false,"message"=>"invalid credentials are wrong","data"=>"No User Found"]);

    }










        // $message = "";$status = 0;
        // try{
        //   $credentials = $request->only('email', 'social_id');

        //   $myTTL = 43200; //minutes
        //       JWTAuth::factory()->setTTL($myTTL);
        //         if (! $token = JWTAuth::attempt($credentials, ['status'=>'1'])) {
        //             $message = 'invalid_credentials';
        //             return response()->json(['status'=>$status,"responseCode"=>"NP997",'message'=>$message,'data'=>json_decode("{}")]);
        //   }
        // //    return $token;
        // //    die;
        //   $user  = JWTAuth::user();

        // //   unset($user->otp);
        // //         unset($user->verified_otp);
        // //         $user->token = $token;
        //         $user->remember_token = $token;

        //         $user->save();
        //         $status = 1;
        //   //dd($request->email,$token,$user->token,$user);
        //   if($request->social_id != "" && ($request->type != "normal" || $request->type != "NORMAL")){
        //     if($request->email != ""){
        //       $userList = User::where('email',$request->email)->first();
        //       if($userList != ""){
        //         $userProfile = DB::table('user_profiles')->where('user_id', $userList->id)->first();
        //         User::where('email',$request->email)->update(['device_token' => $request->device_token]);
        //         if($userProfile)
        //         {
        //           $userList['school_id'] =  $userProfile->school_id;
        //           $userList['class_id'] =  $userProfile->class_id;
        //           $userList['district_id'] =  $userProfile->district_id;
        //           $userList['language_id'] =  $userProfile->language_id;
        //       $userList['roll_no'] =  $userProfile->roll_no;
        //           $userList['token'] =  $userList->token;
        //         }
        //         return response()->json(['status'=>2,'message'=>'Successful Login','data'=>$userList]);
        //       }else{
        //         return response()->json(['status'=>0,'message'=>'Register First','data'=>json_decode("{}")]);
        //       }
        //     }elseif($request->social_id != ""){
        //       $userList = User::where('social_id',$request->social_id)->first();
        //       if($userList != ""){
        //         $userProfile = DB::table('user_profiles')->where('user_id', $userList->id)->first();
        //         User::where('social_id',$request->social_id)->update(['device_token' => $request->device_token]);
        //         if($userProfile)
        //         {
        //           $userList['school_id'] =  $userProfile->school_id;
        //           $userList['class_id'] =  $userProfile->class_id;
        //           $userList['district_id'] =  $userProfile->district_id;
        //           $userList['language_id'] =  $userProfile->language_id;
        //       $userList['roll_no'] =  $userProfile->roll_no;
        //           $userList['token'] =  $userList->token;
        //         }
        //         return response()->json(['status'=>2,'message'=>'Successful Login','data'=>$userList]);
        //       }else{
        //         return response()->json(['status'=>0,'message'=>'Register First','data'=>json_decode("{}")]);
        //       }
        //     }else{
        //       return response()->json(['status'=>0,"responseCode"=>"NP997",'message'=>'Not able to    login','data'=>json_decode("{}")]);
        //     }
        //   }else{
        //     return response()->json(['status'=>0,"responseCode"=>"NP997",'message'=>'Social_id and Type is Required','data'=>json_decode("{}")]);
        //   }
        //     }catch(Exception $e){
        //         return response()->json(['status'=>0,"responseCode"=>"NP997",'message'=>'Not able to    login','data'=>json_decode("{}")]);
        //     }



    }

    public function apilogout(Request $request){

        try{
          JWTAuth::invalidate(JWTAuth::parseToken());
          //JWTAuth::setToken($token)->invalidate();
          return response()->json(['status'=>1,"responseCode"=>"APP001",'message'=>'','data'=>json_decode("{}")]);
        }catch(Exception $e){
          return response()->json(['status'=>0,"responseCode"=>"NP997",'message'=>'Not able to logout','data'=>json_decode("{}")]);  
        }

      }

      public function UserInfo(Request $request){
     $token=$request->token;
       return JWTAuth::setToken($token)->toUser();

      }




    public function createToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


    public function UserRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_id' => 'required|unique:users,social_id',
            'email_id' => 'required',
            'name' => 'required',
            'device_id' => 'required',
            'contact' => 'required'
        ]);
        //   return $request->social_id;
        //   die;
        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => $validator->errors()->toJson(), 400]);
        } else {
            try {
                $newuser = new User;
                $newuser->name = $request->name;
                $newuser->email = $request->email_id;
                $newuser->social_id = $request->social_id;
                $newuser->device_id = $request->device_id;
                $newuser->contact = $request->contact;
                $newuser->password = uniqid();
                $newuser->save();
                return response()->json(['status' => true, 'message' => 'User  Registered Succesfully', 'user' => $newuser]);
            } catch (Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
}
