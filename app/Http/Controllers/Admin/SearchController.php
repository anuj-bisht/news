<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;


class SearchController extends Controller
{
    public function searchNews(Request $request){
     $News=News::where('status', 1)
                            ->where('author','like','%'.$request->key.'%')
                            ->orWhere('source','like','%'.$request->key.'%')
                            ->orWhere('category','like','%'.$request->key.'%')->get();
     if(sizeof(json_decode($News))){
         return response()->json(['status'=>true, 'message'=>'News Fetch Successfully', 'data'=>$News]);
     }
     else{
        return response()->json(['status'=>false, 'message'=>'No News Found', 'data'=>[]]);

     }
    }
}
