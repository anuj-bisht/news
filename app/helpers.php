<?php
use Illuminate\Support\Facades\DB;

function usersCount(){
    $count=DB::table('users')->count();
    return $count;
}

function newssCount(){
    $newscount=DB::table('news')->where('status', 1)->count();
    return $newscount;
}




