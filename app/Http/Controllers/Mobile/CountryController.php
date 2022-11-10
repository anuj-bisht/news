<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function getAllCountries(){
        $country =DB::table('countries')->get();
        return response()->json(['status'=>'true', 'data'=>$country]);
    }
}
