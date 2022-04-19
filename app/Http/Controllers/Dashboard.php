<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merk;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }

    public function index ()
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $pengguna       = User::count();
            $merk           = Merk::count();
            $barang         = Barang::count();
            $penjualan      = Penjualan::count();

            return view('v_dashboard',compact("pengguna","merk","barang","penjualan"));

        }

    }

    public function chart_penjualan(Request $request)
    {

        $result = DB::table('tbl_penjualan')
            ->select(DB::raw('month(tgl_penjualan) as bulan, sum(bayar+kembalian) as total_data'))
            ->where(DB::raw('DATE_FORMAT(tgl_penjualan, "%Y")'),date('Y'))
            ->groupBy(DB::raw('month(tgl_penjualan)'))
            ->get();

            return response()->json($result);

    }

}
