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

    public function listOfPropertiesOwnedLandlord($landlord_id){
        $properties = DB::select('EXEC proc_list_of_properties_owned_landlord @landlord_id = ?', array($landlord_id));
        return response()->json($properties);
    }

    public function soldPropertiesInAMonthReport($landlord_id, $year, $month){
        $properties = DB::select('
                        EXEC proc_sold_properties_in_a_month 
                              @landlord_id = ?
                            , @selling_type = ?
                            , @year = ?
                            , @month = ?', 
                            array($landlord_id, 'BUY', $year, $month));

        return response()->json($properties);
    }

    public function rentedPropertiesInAMonthReport($landlord_id, $year, $month){
        $properties = DB::select('
                        EXEC proc_sold_properties_in_a_month 
                              @landlord_id = ?
                            , @selling_type = ?
                            , @year = ?
                            , @month = ?', 
                            array($landlord_id, 'RENT', $year, $month));

        return response()->json($properties);
    }

    public function top10HighestRentedPropertiesByCityInAYear($city, $year){
        $properties = DB::select('
                        EXEC proc_top_properties_by_city_in_a_year 
                              @top = ?
                            , @city = ?
                            , @selling_type = ?
                            , @year = ?', 
                            array(10, $city, 'RENT', $year));

        return response()->json($properties);
    }

    public function top10HighestSoldPropertiesByCityInAYear($city, $year){
        $properties = DB::select('
                        EXEC proc_top_properties_by_city_in_a_year 
                              @top = ?
                            , @city = ?
                            , @selling_type = ?
                            , @year = ?', 
                            array(10, $city, 'BUY', $year));

        return response()->json($properties);
    }
}
