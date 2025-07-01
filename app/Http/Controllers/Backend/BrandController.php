<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){

        return view('admin.page.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $cat = new Brand;

    if( $image = $request->file('brand_image')){

        $manager = new ImageManager(new Driver());
        $customName = rand().'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(120,120);
        $path = public_path('uploads/brand/'.$customName);
        $img->toPng()->save($path);
        
        $cat->name = $request->brand_name;
        $cat->slug = Str::slug($request->brand_name);
        $cat->image = $customName;
        $cat->save();
    }else {
        $cat->name = $request->brand_name;
        $cat->slug = Str::slug($request->brand_name);
        $cat->save();
    }
        return back()->with('message', 'Brand addeed suscessful');
    
    
  }

    /**
     * Display the specified resource.
     */
    public function show(){

        $brands = Brand::latest()->get();

        return view('admin.page.brand.manage', compact('brands')); 

    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id){

    //     $category = Category::find($id);
    //     return view('admin.page.category.edit', compact("category"));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id){

    //     $categories = Category::find($id);

    //     if($request->cat_image){
    //         if(File::exists(public_path('uploads/category/'.$categories->cat_image))){
    //             File::delete(public_path('uploads/category/'.$categories->cat_image));
    //         }
    //         $image = $request->file('cat_image');
    //         $manager = new ImageManager(new Driver());
    //         $customName = rand().'.'.$image->getClientOriginalExtension();
    //         $img = $manager->read($image);
    //         $img = $img->resize(120,120);
    //         $path = public_path('uploads/category/'.$customName);
    //         $img->toPng()->save($path);

    //         $categories->cat_name = $request->cat_name;
    //         $categories->cat_slug = Str::slug($request->cat_name);
    //         $categories->cat_image = $customName;
    //         $categories->update();
    //      }else {
    //         $categories->cat_name = $request->cat_name;
    //         $categories->cat_slug = Str::slug($request->cat_name);
    //         $categories->update();
    //     }

    //     return redirect()->route('manage.category')->with('message', 'Category Upadated');

        
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){

           $brand = Brand::find($id);
           if(File::exists(public_path('uploads/brand/'.$brand->image))){
            File::delete(public_path('uploads/brand/'.$brand->image));
           }
           $brand->delete();
           return back()->with('message', "Brand Delete SuccessFull.");
    }
}
