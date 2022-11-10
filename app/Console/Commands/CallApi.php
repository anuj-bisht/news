<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;




class CallApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $co=['ae','ar','at','au','be','bg','br','ca','ch','cn','co','cu','cz','de','eg','fr','gb','gr','hk','hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl','pt','ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za'];
        // $cat=['business','entertainment','general','health','science','sports','technology'];


        // $country= implode(" ",Arr::random($co, 1));
        // $category= implode(" ",Arr::random($cat, 1));


        //     $url="https://newsapi.org/v2/top-headlines?country=$country&category=$category&apiKey=b9534b77dc9b41ad950d4ba690938bae";
        //     $Datta=json_decode(file_get_contents($url),true);


        //      $newslength=sizeof($Datta['articles']);


        //      for ($i = 0; $i < $newslength; $i++) {
        //         $news =  DB::table('news')->insert([
        //              'description'=>$Datta['articles'][$i]['description'],
        //              'image'=> ($Datta['articles'][$i]['urlToImage'])?$Datta['articles'][$i]['urlToImage']:'nil',
        //              'author'=> ($Datta['articles'][$i]['author'])?$Datta['articles'][$i]['author']:'nil',
        //              'category'=> ($category)?$category:'nil',
        //              'source'=>($Datta['articles'][$i]['source']['name'])?$Datta['articles'][$i]['source']['name']:'nil',
        //              'country'=> ($country)?$country:'nil',
        //              'status'=>1,
        //              'editable'=>'no',
        //              'image'=> $Datta['articles'][$i]['urlToImage'],
        //              'url'=> $Datta['articles'][$i]['url'],
        //         ]);

        //     }
    }
}
