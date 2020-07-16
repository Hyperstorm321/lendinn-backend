<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function listOfPropertiesOwned($user_id){
        $properties = DB::select('EXEC proc_list_of_properties_owned @user_id = ?', array($user_id));
        return response()->json($properties);
    }
}
