<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    public function getAllCategories(){
        $category =DB::table('categories')->get();
        return response()->json(['status'=>'true', 'data'=>$category]);
    }
}
