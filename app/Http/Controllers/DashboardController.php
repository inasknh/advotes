<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenjagaTPS;
use App\Fakultas;
use App\Http\Controllers\LoginController;
use App\Admin;
use App\Kandidat;
use App\Pemilihan;
use App\Pemilih;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAdmin = LoginController::getAdmin($request);
        $role = $userAdmin->role;

        if($role == "admin fakultas") {
            $daftarPemilihan = Pemilihan::where('id_fakultas', $userAdmin->id_fakultas)
                ->orderBy('nama', 'ASC')->get();
        }else if($role == "admin pemilihan") {
            $daftarPemilihan = Pemilihan::where('id_admin', $userAdmin->id)
                ->orderBy('nama', 'ASC')->get();
        }

        $pageTitle = "Dashboard";
        return view('dashboard')->with(compact('daftarPemilihan', 'userAdmin', 'pageTitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistik(Request $request, $id_pemilihan)
    {
        $userAdmin = LoginController::getAdmin($request);
        $pemilihan = Pemilihan::where('id', $id_pemilihan)->first();
        $jumlahKandidat= Kandidat::where('id_pemilihan', $id_pemilihan)->count();
        $jumlahPemilih = Pemilih::whereIn('id', function($query) use ($id_pemilihan) {
            $query->select('id_pemilih')
                ->from('daftar_dpt_pemilihan')
                ->whereIn('id_pemilihan', explode(',', $id_pemilihan));
        })->count();
        
        $jumlahPenjaga = PenjagaTPS::where('id_fakultas', $userAdmin->id_fakultas)->count();
        $pageTitle = "Dashboard";

        return view('statistik')->with(compact('userAdmin','jumlahPemilih','jumlahKandidat', 'pemilihan', 'jumlahPenjaga', 'pageTitle'));
    }

}
