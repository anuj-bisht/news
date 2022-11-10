<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\News;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
{
    public function News(){
        $Datta['data']=DB::table('news')->select('status', 'description','url', 'image', 'category', 'author','editable', 'id')->paginate(20);

        $Datta['categories']=DB::table('categories')->get();
     return view('admin/apinews',$Datta);
    }


    public function NewsEdit(Request $request, News $id){
         $data['category']= DB::table('categories')->get();
         $data['country']= DB::table('countries')->get();
         $data['news']= $id;

         return view('admin/News/editnews', $data);


    }

    public function AddNews(){
        $data['category']= DB::table('categories')->get();
        $data['country']= DB::table('countries')->get();
        return view('admin/News/addnews', $data);
    }



    public function SubmitNews(Request $request){
        if($request->hasFile('image')){

            $image=$request->file('image');
            $name=time().'.'.$image->getClientOriginalExtension();
           $image_path= $image->move('News', $name);

          }
        DB::table('news')->where('id', $request->id)->insert([
            'description'=>$request->description,
            'author'=>$request->author,
            'url'=>$request->url,
            'category'=>$request->category,
            'country'=>$request->country,
            'image'=>$image_path,
            'source'=>$request->source,
            'status'=>1,
            'created_at'=>Carbon::now()->addDays(15),
            'editable'=>$request->editable

        ]);
        return redirect('new');
    }

    public function NewsUpdate(Request $request){
      if($request->hasFile('image')){

        $image=$request->file('image');
        $name=time().'.'.$image->getClientOriginalExtension();
       $image_path= $image->move('News', $name);

      }else{
          $image_path="https://estaticos-cdn.prensaiberica.es/clip/b1dd3ad2-afb0-447b-9e9c-f266d5e0cdff_16-9-aspect-ratio_default_0.jpg";
      }
      DB::table('news')->where('id', $request->id)->update([
        'description'=>$request->description,
        'author'=>$request->author,
        'url'=>$request->url,
        'category'=>$request->category,
        'country'=>$request->country,
        'image'=>$image_path,
        'source'=>$request->source,
        'status'=>1,
        'editable'=>$request->editable

    ]);
    return redirect('new');


   }
   public function newsStatus($user_id, $value){
    if($value=='yes'){
        DB::table('news')->where('id',$user_id)->update(['status'=>1]);
        return response()->json(['status'=>'User Activated']);
    }elseif($value=='no'){
        DB::table('news')->where('id',$user_id)->update(['status'=>0]);
        return response()->json(['status'=>'User Deactivated']);
    }
}

    public function SaveNews(Request $request){
        $validator = Validator::make($request->all(), [
            'url' => 'required|unique:news,url',

        ]);
        //$validator->errors()
        if($validator->fails()){

        }
    $co=['ae','ar','at','au','be','bg','br','ca','ch','cn','co','cu','cz','de','eg','fr','gb','gr','hk','hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl','pt','ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za'];
    $cat=['business','entertainment','general','health','science','sports','technology'];


    $country= implode(" ",Arr::random($co, 1));
    $category= implode(" ",Arr::random($cat, 1));


        $url="https://newsapi.org/v2/top-headlines?country=$country&category=$category&apiKey=b9534b77dc9b41ad950d4ba690938bae";
        $Datta=json_decode(file_get_contents($url),true);
    // echo "<pre>";
    // print_r($Datta['articles'][0]['title']);
    // die;

         $newslength=sizeof($Datta['articles']);
        // for($i=0; $i<$newslength; $i++){
        //     // $news= new News;
        //     // $news=  $Datta['articles'][$i]['title'];
        //     // $news->image=  $Datta['articles'][$i]['urlToImage'];
        //     // $news->save;
        //     return $news;
        // }

         for ($i = 0; $i < $newslength; $i++) {
            $news =  DB::table('news')->insert([
                 'description'=>$Datta['articles'][$i]['description'],
                 'image'=> ($Datta['articles'][$i]['urlToImage'])?$Datta['articles'][$i]['urlToImage']:'nil',
                 'author'=> ($Datta['articles'][$i]['author'])?$Datta['articles'][$i]['author']:'nil',
                 'category'=> ($category)?$category:'nil',
                 'source'=>($Datta['articles'][$i]['source']['name'])?$Datta['articles'][$i]['source']['name']:'nil',
                 'country'=> ($country)?$country:'nil',
                 'status'=>1,
                 'editable'=>'no',
                 'image'=> $Datta['articles'][$i]['urlToImage'],
                 'url'=> $Datta['articles'][$i]['url'],
            ]);

        }

    die;
     return view('admin/apinews',$Datta);
    }


    public function newsCategory($cat){

         $news=DB::table('news')->where('category', $cat)->get();
         return $news;
    }

}
