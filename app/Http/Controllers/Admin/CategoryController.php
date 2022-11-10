<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function allCategory(Request $request, Category $key){
         $category['categories']=$key->all();
         return view('admin/Category/category', $category );
}

   public function addCategory(){
       return view('admin.Category.addcategories');
   }
   public function submitCategory(Request $request){
     DB::table('categories')->insert([
         'categories'=>$request->category
     ]);
     return redirect('categories');
}

public function editCategory(Request $request, $id){
   $data['category']= DB::table('categories')->where('id', $id)->first();

    return view('admin.Category.editcategory', $data);
}
public function updateCategory(Request $request){
    DB::table('categories')->where('id', $request->category_id)->update([
        'categories'=>$request->category
    ]);
    return redirect('categories');
}
}
