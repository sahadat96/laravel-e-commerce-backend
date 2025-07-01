<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class SliderController extends Controller
{
//function for showing slider page
   public function index(){
     return view('admin.page.slider.add_slider');
   }

//function for create slider 
   public function create(Request $request){
    $create_slider = new Slider;
    
    $slider_image = $request->file('slide_image');
    $manager = new ImageManager( new Driver());
    $customName = rand().'.'.$slider_image->getClientOriginalExtension();
    $img = $manager->read($slider_image);
    $image = $img->resize(2376, 806 );
    $path = public_path('uploads/slider/'.$customName);
    $image->toPng()->save($path);

    $create_slider->title = $request->slider_title;
    $create_slider->category = $request->slider_category;
    $create_slider->description = $request->slider_description;
    $create_slider->pic = $customName;
    $create_slider->save();

    return redirect()->back()->with('message', 'slider added successfull');
   }

//function for show slider in frontend page
  static function show(){
    $show = new Slider;

     $slide_show = $show->orderBy('title', 'ASC')->get();

     return response()->json($slide_show);
  }




//Function for slider manage
    public function manage(){
        $slider = new Slider;
        
        $slider_manage = $slider->all();

        return view('admin.page.slider.slider_manage', compact('slider_manage'));
    }
//function for delete slider
   public function delete($id){
        $slider = new Slider;

        $delete_slider = $slider->find($id);
        if(File::exists(public_path('uploads/slider/'.$delete_slider->pic))){
          File::delete(public_path('uploads/slider/'.$delete_slider->pic));
        }
        $delete_slider->delete();
        return redirect()->back()->with('message', "Slider Delete Successfull");

   }

   
}
