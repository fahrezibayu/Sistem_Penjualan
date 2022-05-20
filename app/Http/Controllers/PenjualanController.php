<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanTemp;
use App\Models\PenjualanTrn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenjualanController extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");
    }

    public function pos(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $sql    = PenjualanTemp::get();
            $total  = 0;
            foreach ($sql as $key) {
                $query  = Barang::where("id_barang", $key['id_barang'])->first();
                $total += $query->harga_barang * $key['qty'];
            }
            $barang = Barang::all();

            $max = Penjualan::max("id_penjualan");

            $urutan = (int) substr($max, 8, 3);
            $urutan++;
            $date = date("dmY");
            $huruf = $date;
            $kodepenjualan = $huruf . sprintf("%03s", $urutan);

            return view('penjualan.v_pos', compact("barang", "total", "kodepenjualan"));
        }
    }

    public function save_temp(Request $request)
    {

        $id_barang      = $request->id_barang;
        $qty            = $request->qty;

        $count           = PenjualanTemp::where("id_barang", $id_barang)->count();

        if ($count > 0) {

            $temp           = PenjualanTemp::where("id_barang", $id_barang)->first();

            PenjualanTemp::where('id_barang', $id_barang)->update([
                'qty'           => $temp->qty + $qty
            ]);
        } else {

            PenjualanTemp::create([
                'id_barang'     => $id_barang,
                'qty'           => $qty
            ]);
        }

        return redirect("/penjualan/pos");
    }

    public function show_temp(Request $request)
    {

        $sql    = PenjualanTemp::all();
        return view("penjualan.v_data_temp", compact("sql"));
    }

    public function delete_temp($id)
    {

        PenjualanTemp::where('id', $id)->delete();
        return redirect("/penjualan/pos");
    }

    public function update_temp(Request $request)
    {

        $name       = htmlspecialchars(addslashes($request->name));
        $value      = htmlspecialchars(addslashes($request->value));
        $pk         = htmlspecialchars(addslashes($request->pk));

        PenjualanTemp::where('id', $pk)->update([
            $name      => $value
        ]);
    }

    public function save_transaksi(Request $request)
    {

        $bayar          = $request->bayar;
        $total          = $request->total;
        $kembalian      = $request->kembalian;
        $id_penjualan   = $request->id_penjualan;

        Penjualan::create([
            'id_penjualan'      => $id_penjualan,
            'bayar'             => $bayar,
            'total'             => $total,
            'kembalian'         => $kembalian,
            'id_user'           => Auth::user()->id,
            'tgl_penjualan'     => date("Y-m-d")
        ]);

        $temp = PenjualanTemp::get();
        foreach ($temp as $key) {

            $barang  = Barang::where("id_barang", $key['id_barang'])->first();

            $total   = $key['qty'] * $barang->harga_barang;

            PenjualanTrn::create([
                'id_penjualan'      => $id_penjualan,
                'id_barang'         => $key['id_barang'],
                'qty'               => $key['qty'],
                'harga_barang'      => $barang->harga_barang,
                'total'             => $total
            ]);
        }

        DB::table('tbl_penjualan_temp')->truncate();

    }

    public function laporan(Request $request)
    {


        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $penjualan = Penjualan::where("tgl_penjualan", date("Y-m-d"))->get();

            return view('penjualan.v_laporan', compact("penjualan"));
        }
    }

    public function search_laporan(Request $request)
    {


        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $date1      = date('Y-m-d', strtotime($request->date1));
            $date2      = date('Y-m-d', strtotime($request->date2));

            $penjualan      = Penjualan::whereBetween("tgl_penjualan", [$date1, $date2])->get();
            return view('penjualan.v_laporan', compact("penjualan"));
        }
    }

    public function detail_lap(Request $request)
    {

        $id         = $request->id;

        $penjualan  = PenjualanTrn::where("id_penjualan", $id)->get();
        return view("penjualan.v_detail_laporan", compact("penjualan"));
    }

    public function struk($id)
    {
        $id_penjualan = $id;
        $penjualan = DB::table('tbl_penjualan')
            ->where("id_penjualan", $id)
            ->first();
        $detail_penjualan = PenjualanTrn::where("id_penjualan", $id)->get();

        return view("penjualan.struk.v_struk", compact("id_penjualan", "penjualan", "detail_penjualan"));
    }
    public function struk_ulang($id)
    {
        $id_penjualan = $id;
        $penjualan = DB::table('tbl_penjualan')
            ->where("id_penjualan", $id)
            ->first();
        $detail_penjualan = PenjualanTrn::where("id_penjualan", $id)->get();

        return view("penjualan.struk.v_struk_ulang", compact("id_penjualan", "penjualan", "detail_penjualan"));
    }
}
