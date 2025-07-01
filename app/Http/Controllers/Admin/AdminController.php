<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function login(){
        return view('admin.login');
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
   
    public function profile(){
        $admininfo = User::find(Auth::user()->id);
        return view('admin.includes.profile', compact('admininfo'));
    }
    
    public function updateprofile(Request $request, $id){
       
        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        
        
        if($request->image){
            if(File::exists(public_path('backend/uploads/admin/'.$admin->pic))){
                File::delete(public_path('backend/uploads/admin/'.$admin->pic));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $customName = rand().'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(150,150);
            $path = public_path('backend/uploads/admin/'.$customName);
            $img->toPng()->save($path);
            $admin->pic = $customName;
            
        }
        $admin->save();
        return back();
    }
}
