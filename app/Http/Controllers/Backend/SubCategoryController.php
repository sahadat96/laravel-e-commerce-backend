<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index(){
         $categories = Category::all();

        return view('admin.page.subcategory.add', compact('categories'));
    }
    
    public function store(Request $request){
        $subcat = new SubCategory;

    if( $image = $request->file('sub_cat_image')){

        $manager = new ImageManager(new Driver());
        $customName = rand().'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(120,120);
        $path = public_path('uploads/subcategory/'.$customName);
        $img->toPng()->save($path);
        
        $subcat->subcat_name = $request->subcat_name;
        $subcat->cat_id = $request->sub_cat_name;
        $subcat->subcat_slug = Str::slug($request->subcat_name);
        $subcat->subcat_image = $customName;
        $subcat->save();
    }else {
        $subcat->subcat_name = $request->subcat_name;
        $subcat->cat_id = $request->sub_cat_name;
        $subcat->subcat_slug = Str::slug($request->subcat_name);
        $subcat->save();
    }
        return back()->with('message', 'Sub Category addeed');
    
  }
 
  public function show(){

    $categories = SubCategory::latest()->get();

    return view('admin.page.subcategory.manage', compact('categories')); 

 }
 public function destroy(string $id){

    $categories = SubCategory::find($id);
    if(File::exists(public_path('uploads/subcategory/'.$categories->subcat_image))){
     File::delete(public_path('uploads/subcategory/'.$categories->subcat_image));
    }
    $categories->delete();
    return back()->with('message', "Sub Category Delete SuccessFull.");
 }

}
