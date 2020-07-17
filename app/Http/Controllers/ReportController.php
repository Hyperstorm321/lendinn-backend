<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function listOfRentedAndBoughtProperties($user_id){
        $properties = DB::select('EXEC proc_list_of_rented_and_bought_properties @user_id = ?', array($user_id));
        return response()->json($properties);
    }

    public function listOfOwnedProperties($landlord_id){
        $properties = DB::select('EXEC proc_list_of_owned_properties @landlord_id = ?', array($landlord_id));
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

    public function top5HighestRentedPropertiesByCityInAYear($city, $year){
        $properties = DB::select('
                        EXEC proc_top_properties_by_city_in_a_year 
                              @top = ?
                            , @city = ?
                            , @selling_type = ?
                            , @year = ?', 
                            array(5, $city, 'RENT', $year));

        return response()->json($properties);
    }

    public function top5HighestSoldPropertiesByCityInAYear($city, $year){
        $properties = DB::select('
                        EXEC proc_top_properties_by_city_in_a_year 
                              @top = ?
                            , @city = ?
                            , @selling_type = ?
                            , @year = ?', 
                            array(5, $city, 'BUY', $year));

        return response()->json($properties);
    }
}
