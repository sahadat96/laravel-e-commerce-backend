<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Districs;
use App\Models\ShippingState;

class AreaControlleFrontend extends Controller
{
    public function getDivision(){
        
      $get_division = new Division;

      $division = $get_division->all();

      return response()->json([
          'division' => $division
      ]);

    }

    public function get_districts($division_id){
        $getDistrict = new Districs;
 
        $distric = $getDistrict->where('division_Id', $division_id )->orderBy('distric_name', 'ASC')->get();

      return response()->json(
        [ 'distric' => $distric ]
      );
    }

    

    public function get_states($district_id){
        $getDistrict = new ShippingState;
 
        $state = $getDistrict->where('districs_id', $district_id )->orderBy('state_name', 'ASC')->get();

      return response()->json(
        [ 'state' => $state ]
      );
    }

}
