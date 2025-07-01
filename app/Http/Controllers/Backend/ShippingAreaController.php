<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Districs;
use App\Models\ShippingState;

class ShippingAreaController extends Controller
{
    public function index(){
        return view('admin.page.shipingarea.division');
    }
    
    public function create(Request $request){
  
        $request->validate([
            'division_name' => 'required',
        ]);
   
       $division = new Division;

       $division->division_name = $request->division_name;
       $division->save();

       return redirect()->back()->with('message', "Division added Successfull");
    }

    public function showDivision(){
        $division = new Division;

        $show_division = $division->all();

        return view('admin.page.shipingarea.divisionmanage', compact('show_division'));
    }
    
    public function deleteDivision($id){
         $division = new Division;
         
         $division->find($id)->delete();
        
         return redirect()->back()->with('message', "Division Name Delete Successful");
    }

    //for distric
    public function distric(){
        $division = new Division;

        $show_division = $division->all();

        return view('admin.page.shipingarea.districs', compact('show_division'));
    }

    public function addDistric(Request $request){
        $distric = new Districs;
      
        $distric->division_Id = $request->division_id;
        $distric->distric_name = $request->distric_name;


        $distric->save();

        return redirect()->back()->with('message', "Distric Added Successful");
    }

    public function showDistric(){
        $districs = new Districs;

        $show_distric = $districs->all();

        return view ('admin.page.shipingarea.districs_show', compact('show_distric'));
    }

    public function deletDistric($id){
        $districs = new Districs;
        
        $districs->find($id)->delete();
       
        return redirect()->back()->with('message', "Distric Delete Successful");
   }

   public function state(){
        $division = new Division;
        $districs = new Districs;

        $show_division = $division->all();
        $show_distric = $districs->all();

        return view ('admin.page.shipingarea.shippingstate', compact('show_distric', 'show_division'));
    }

//for get District with ajax
    public function getDistrict($division_id){
        $get_dist = new Districs;

        $dist = $get_dist->where('division_id', $division_id)->orderBy('distric_name', 'ASC')->get();
        return response()->json($dist);
    }

    public function addState(Request $request){
        $state = new ShippingState;

        $state->division_id = $request->division_id;
        $state->districs_id = $request->district_id;
        $state->state_name = $request->state_name;

        $state->save();
        return redirect()->back()->with('message', "State Added Successful");
    }

    public function showState(){
        $state = new ShippingState;

        $get_state = $state->all();

        return view('admin.page.shipingarea.state_manage', compact('get_state'));
    }

    public function deleteState($id){
       $state = new ShippingState;

       $delete_state = $state->find($id);
       $delete_state->delete();

       return redirect()->bacK()->with('message', "State Name Delete Successful");

    }



}
