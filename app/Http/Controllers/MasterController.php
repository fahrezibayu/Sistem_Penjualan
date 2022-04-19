<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\LogSession;
use App\Models\Merk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
{


    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }


    public function merk(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $merk = Merk::all();

            return view('master.v_merk',compact('merk'));

        }

    }

    public function save_merk(Request $request)
    {

        $nama   = $request->nama_merk;
        Merk::create([
            'nama_merk'      => $nama,
        ]);
        return redirect('/master/merk');

    }

    public function update_merk(Request $request)
    {

        $name       = htmlspecialchars(addslashes($request->name));
        $value      = htmlspecialchars(addslashes($request->value));
        $pk         = htmlspecialchars(addslashes($request->pk));

        Merk::where('id_merk', $pk)->update([
            $name      => $value
        ]);

    }

    public function delete_merk($id)
    {

        Merk::where('id_merk',$id)->delete();
        return redirect("/master/merk");

    }

    public function check_merk (Request $request)
    {

        $id     = $request->id;
        $check  = Merk::where("nama_merk", "=", $id)->get()->count();
        echo    $check;

    }

    public function barang(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $barang = Barang::all();
            $merk   = Merk::all();
            $max = Barang::max("id_barang");

            $urutan = (int) substr($max, 3, 3);
            $urutan++;
            $huruf = "BRG";
            $kodebarang = $huruf . sprintf("%03s", $urutan);
            return view('master.v_barang',compact('barang','merk','kodebarang'));

        }

    }

    public function save_barang(Request $request)
    {

        $id_barang       = $request->id_barang;
        $nama_barang     = $request->nama_barang;
        $id_merk         = $request->id_merk;
        $harga_barang    = $request->harga_barang;

        if ($request->file("file") == null) {
            $name_file = $request->input("file");
        } else {
            $file =   $request->file("file");
            $name_file = $nama_barang;
            $file->move(public_path("assets/img/products"), $name_file);
        }

        Barang::create([
            'id_barang'          => $id_barang,
            'nama_barang'        => $nama_barang,
            'id_merk'            => $id_merk,
            'harga_barang'       => $harga_barang,
            'foto'               => $name_file,
            'id_user'            => Auth::user()->id
        ]);

        return redirect('/master/barang');

    }

    public function edit_barang($id)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $barang          = Barang::where("id_barang",$id)->first();
            $merk            = Merk::all();
            return view("master.e_barang",compact('barang','merk'));

        }


    }

    public function update_barang(Request $request)
    {

        $id             = $request->id;
        $nama_barang    = $request->nama_barang;
        $id_merk        = $request->id_merk;
        $harga_barang   = $request->harga_barang;

        if ($request->file("file") == null) {
            $name_file = $request->input("file_l");
        } else {
            $file_l =   $request->file_l;
            File::delete('assets/img/products/'.$file_l);
            $file =   $request->file("file");
            $name_file = $nama_barang;
            $file->move(public_path("assets/img/products"), $name_file);
        }



        Barang::where('id_barang',$id)->update([
            'nama_barang'          => $nama_barang,
            'id_merk'              => $id_merk,
            'harga_barang'         => $harga_barang,
            'foto'                 => $name_file,
        ]);

        return redirect('/master/barang');

    }

    public function delete_barang($id)
    {

        $barang = Barang::where("id_barang", $id)->first();
        File::delete('assets/img/products/'.$barang->foto);
        Barang::where("id_barang",$id)->delete();
        return redirect('/master/barang');

    }

    public function pengguna(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $pengguna          = User::all();
            return view("master.v_pengguna",compact('pengguna'));

        }

    }

    public function save_pengguna(Request $request)
    {

        $nama       = $request->nama;
        $username   = $request->username;
        $password   = bcrypt($request->password);
        $level      = $request->level;
        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto");
        } else {
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->username).'.'.$extension;
            $photo->move(public_path("assets/img/profile"), $file_photo);
        }

        User::create([

            'name'          => $nama,
            'username'      => $username,
            'role'          => $level,
            'password'      => $password,
            'foto'          => $file_photo,

        ]);

        return redirect('/master/pengguna');

    }

    public function delete_pengguna($id)
    {

        User::where('id',$id)->delete();
        return redirect("/master/pengguna");

    }

    public function edit_pengguna($id)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $pengguna = User::where('id',$id)->first();
            return view("master.e_pengguna",compact('pengguna'));

        }

    }

    public function update_pengguna(Request $request)
    {

        $id         = $request->id;
        $role    = $request->level;

        User::where("id",$id)->update([
            'role'       => $role,
        ]);

        return Redirect::back();

    }

    public function data_session (Request $request)
    {

        $datenow = date("Y-m-d");

        if(isset($request->ctgl1) || isset($request->ctgl2) || isset($request->cgroup)){

            $ctgl1 = $request->ctgl1;
            $ctgl2 = $request->ctgl2;
            $group = $request->cgroup;

            // $sql = DB::table('log_session')->whereBetween('tanggal_in', [$ctgl1, $ctgl2])->orderBy('id', 'DESC')->get();
            $sql = LogSession::whereBetween('tanggal_in', [$ctgl1, $ctgl2])->orWhere('id', $group)->orderBy('id', 'DESC')->get();
            return view("master.v_data_session",compact('sql'));

        } else {

            $sql = LogSession::where('tanggal_in', $datenow)->orderBy('id' , 'DESC')->get();
            return view("master.v_data_session",compact('sql'));
            // dd($datenow);

        }

        // return view("user.data_log",compact("sql"));
    }

}
