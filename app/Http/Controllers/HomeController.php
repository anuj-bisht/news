<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataa= DB::table('news')->selectRaw('count(*) as total , category')->groupBY('category')->where('status', 1)->get();
           $cate='';
        foreach($dataa as $dat){
            $cate.="['".$dat->category."', ".$dat->total."],";
            // $cate.="['".$dat->category."']";

        }

        $data['category']=rtrim($cate, ",");


        return view('admin/dashboard', $data);
    }
    // public function dashboard()
    // {
    //     return view('admin/dashboard');
    // }
}
