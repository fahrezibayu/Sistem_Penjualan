<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }

    public function aplikasi ()
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            return view('setting.v_setting_aplikasi');

        }

    }

    public function update_aplikasi (Request $request)
    {

        $nama           = $request->nama;
        $nama_aplikasi  = $request->nama_aplikasi;


        if ($request->file("photo") == null) {
            $file_photo = $request->input("photo_l");
        } else {
            $photo =   $request->file("photo");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->namaapps).'.'.$extension;
            $photo->move(public_path("assets/img/logo"), $file_photo);
        }

        DB::table('tbl_profile_app')->update([

            'nama'          => $nama,
            'nama_aplikasi' => $nama_aplikasi,
            'photo'         => $file_photo

        ]);

        return redirect('/setting/aplikasi');

    }

    public function profile_user($id)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $user = User::where('id',$id)->first();
            return view("setting.v_profile_user",compact('user'));

        }

    }

    public function update_profile_user(Request $request)
    {

        $id         = $request->id;
        $nama       = $request->nama;
        $username   = $request->username;
        $user = User::where("id",$id)->first();

        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto_l");
        } else {
            File::delete('assets/img/profile/'.$request->foto_l);
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->username).'.'.$extension;
            $photo->move(public_path("assets/img/profile"), $file_photo);
        }

        if ($user->username != $username) {

            User::where("id",$id)->update([
                'name'          => $nama,
                'username'      => $username,
                'foto'          => $file_photo
            ]);

            return redirect("/sign_out");

        } else {

            User::where("id",$id)->update([
                'name'          => $nama,
                'username'      => $username,
                'foto'          => $file_photo
            ]);

            return Redirect::back();

        }


    }

    public function update_password (Request $request)
    {

        $password2      = $request->password2;
        $id             = $request->id;

        $hashPassword2 = bcrypt($password2);

        User::where('id', $id)->update([
            'password' => $hashPassword2
        ]);

    }

    public function delete_foto_profile($id)
    {

        $user = User::where('id',$id)->first();
        $foto = $user->foto;
        File::delete('assets/img/profile/'.$foto);
        User::where('id',$id)->update([
            'foto'      => ''
        ]);
        return Redirect::back();

    }

}
