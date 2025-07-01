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

class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.register');
    }

    public function loginpage(){
        return view('vendor.login');
    }

    public function registration(Request $request): RedirectResponse
    {
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

       // event(new Registered($vendor));

       // Auth::guard('vendor')->login($vendor);

       return redirect('/vendor/register')->with('status', 'Vendor Registration successfully!');
        
    }

    public function login(Request $request): RedirectResponse 
    {

         $check = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::guard('vendor')->attempt(['email' => $check['email'], 'password' => $check['password'] ])) {

                $request->session()->regenerate();
                
                $url ="vendor/dashboard";

              return redirect()->intended($url);
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

    public function dashboard(){
        return view('vendor.dashboard');
    }

    public function logout(Request $request){
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

}
