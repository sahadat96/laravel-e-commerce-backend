<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        return view('admin.page.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $cat = new Category;

    if( $image = $request->file('cat_image')){

        $manager = new ImageManager(new Driver());
        $customName = rand().'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(120,120);
        $path = public_path('uploads/category/'.$customName);
        $img->toPng()->save($path);
        
        $cat->cat_name = $request->cat_name;
        $cat->cat_slug = Str::slug($request->cat_name);
        $cat->cat_image = $customName;
        $cat->save();
    }else {
        $cat->cat_name = $request->cat_name;
        $cat->cat_slug = Str::slug($request->cat_name);
        $cat->save();
    }
        return back()->with('message', 'category addeed suscessful');
    
    
  }

    /**
     * Display the specified resource.
     */
    public function show(){

        $categories = Category::latest()->get();

        return view('admin.page.category.manage', compact('categories')); 

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){

        $category = Category::find($id);
        return view('admin.page.category.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        $categories = Category::find($id);

        if($request->cat_image){
            if(File::exists(public_path('uploads/category/'.$categories->cat_image))){
                File::delete(public_path('uploads/category/'.$categories->cat_image));
            }
            $image = $request->file('cat_image');
            $manager = new ImageManager(new Driver());
            $customName = rand().'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(120,120);
            $path = public_path('uploads/category/'.$customName);
            $img->toPng()->save($path);

            $categories->cat_name = $request->cat_name;
            $categories->cat_slug = Str::slug($request->cat_name);
            $categories->cat_image = $customName;
            $categories->update();
         }else {
            $categories->cat_name = $request->cat_name;
            $categories->cat_slug = Str::slug($request->cat_name);
            $categories->update();
        }

        return redirect()->route('manage.category')->with('message', 'Category Upadated');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){

           $categories = Category::find($id);
           if(File::exists(public_path('uploads/category/'.$categories->cat_image))){
            File::delete(public_path('uploads/category/'.$categories->cat_image));
           }
           $categories->delete();
           return back()->with('message', "Category Delete SuccessFull.");
    }


    // get category with subcategory for api
    public function getCategories()
    {
        $categories = Category::with('getSubCategory')->where('status', 'active')->get();
        return response()->json($categories);
    }
}
