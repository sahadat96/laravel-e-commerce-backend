<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class VendorRegisterController extends Controller
{
    public function index(){
        return view('vendor.register');
    }

    public function registration(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Vendor::class],
            'phone' => ['required', 'string', 'unique:'.Vendor::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $vendor = new Vendor;
        $vendor->shop_name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = Hash::make($request->password); 
        $vendor->save();

        event(new Registered($vendor));
        
        //Auth::login($vendor);
         
        return redirect(RouteServicerovider::HOME);
        
    }

    public function login(Request $request){
        $check = $request->all();
        if(Auth::guard('vendor')->attempt(['email' => $check['email'], 'password' => $check['password'] ])){
            return redirect()->route('vendor.dashboard')->with('error', 'vendor login successfully');
        }else{
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

}
