<?php

namespace App\Http\Controllers;

use App\Models\LogSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }

    public function index ()
    {

        if (!Session::get('login')) {

            return view("v_login");

        } else {

            if (Auth::user()->role == 'Admin') {
                return redirect('/dashboard');
            } else {
                return redirect('/penjualan/pos');
            }

        }

    }

    public function sign_in (Request $request) {


        if (Auth::attempt($request->only('username','password'))) {

            Session::put("role",Auth::user()->role);
            Session::put("create_at",Auth::user()->created_at);


            Session::put("login",TRUE);

            LogSession::create([
                'id'            => Auth::user()->id,
                'tanggal_in'    => date('Y-m-d'),
                'jamin'         => date('H:i:s'),
                'status'        => 'Online',
                'tanggal_out'   => NULL,
                'jamout'        => NULL
            ]);

            return redirect('/dashboard');


        }   return view("v_login");

    }

    public function sign_out (Request $request)
    {

        LogSession::where('id',Auth::user()->id)->update([
            'tanggal_out'       => date('Y-m-d'),
            'jamout'            => date('H:i:s'),
            'status'            => 'Offline'
        ]);


        $request->session()->forget('login');
        Auth::logout();
        return redirect("/");

    }

}
