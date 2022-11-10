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

class PreferenceController extends Controller
{
    public function UserPreferences(Request $request){
          //return $request->bearerToken();          for beaer
          //return $request->header('token');        for header
try{
      $user_id=JWTAuth::setToken($request->header('token'))->toUser()->id;
    //   return $request->country;
    //   die;
       $preference=DB::table('preferences')->insert([
             'user_id'=>$user_id,
             'device_id'=>$request->device_id,
             'category'=>($request->category)?$request->category:'nil',
             'country'=>($request->country)?$request->country:'nil',
               ]);

       return response()->json(["status"=>true,"message"=>"User Prefernces Save Successfully"]);

      }catch(\Exception $e){
        return response()->json(["status"=>false,"message"=>$e->getMessage()]);

          }
    }

    public function PreferencesData(Request $request){
        $user_id = JWTAuth::setToken($request->header('token'))->toUser()->id;

      $data=  DB::table('preferences')->where('user_id', $user_id)->first();

      $category['id']= json_decode($data->category);
      if (is_array( $category['id']) &&  $category['id'] != null) {
      $allcategory=[];
      foreach($category['id'] as $categoryy){
        $d=DB::table('categories')->where('id', $categoryy)->first();
        array_push($allcategory, $d);
     }
    }else{
        $allcategory=[];
    }

       $length=sizeof($allcategory);
       $data=[];
       $original_category=[];
        if($length > 0){
        for($i=0; $i<$length; $i++){
             $catee=$allcategory[$i]->categories;
             $news=DB::table('news')->select('author', 'source', 'url', 'image', 'country', 'category', 'description', 'id')->where('category', $catee)->get();
            array_push($original_category, $news);
        }
        $data['preferences data']=$original_category;
       }

       else{
        $original_category=[];
       }
       return response()->json(['Success' => true, 'Message' => "Preferences News Fetched Successfully", 'Data' => $data]);


  }
}
