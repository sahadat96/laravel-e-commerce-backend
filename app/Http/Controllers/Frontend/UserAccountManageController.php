<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class UserAccountManageController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $user = new User;

        $get_user = $user->find($user_id);

     return view('user.myaccount', compact('get_user'));

    }

    // show user dashboard page
    public function userDashbaord(){
        $user_id = Auth::user()->id;
        $user = new User;

        $get_user = $user->find($user_id);

        return view('user.user_dashbaord', compact('get_user'));
    }

    // order track
    public function orderTrack(){
        return view('user.order_track');
    }

    // myaddress
    public function myAddress(){
        $user_id = Auth::user()->id;
        $user = new User;

        $get_user = $user->find($user_id);

        return view('user.my_address', compact('get_user'));

    }

    // change password page 
    public function changePassword(){
        return view('user.change_password');
    }



}
