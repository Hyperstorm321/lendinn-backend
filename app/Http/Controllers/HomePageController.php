<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UsersProperties;

class HomePageController extends Controller
{
    public function get(){
        return response()->json(UsersProperties::get());
    }

    public function myProperties($id){
        $myProperties = UsersProperties::where('landlord_id',$id)->get();
        return response()->json($myProperties);
    }

}
