<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Fakultas;
use App\Pemilihan;
use App\Pemilih;
use App\Kandidat;
use App\DPTPemilihan;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\Controller;
use PrakashDivy\Laravel\OAuth2\UI\Facades\UI;
use App\Http\Controllers\LoginController;

class PemilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $userRole = $userAdmin->role;

        if($userAdmin->role == 'superuser'){
            $daftarPemilihan = Pemilihan::orderBy('id_fakultas', 'ASC')->get();
        }else if($userRole == 'admin fakultas'){
             $daftarPemilihan = Pemilihan::where('id_fakultas', $userAdmin->id_fakultas)
             ->orderBy('id', 'ASC')->get(); 
        }else{
            $daftarPemilihan = Pemilihan::where('id_admin', $userAdmin->id)
              ->orderBy('id', 'ASC')->get();
        }
        $pageTitle = 'Admin';

        return view('listPemilihan')->with(compact('daftarPemilihan', 'user', 'userAdmin', 'pageTitle'));
    }

    //get pemilihan yang dia pegang
    public function find(Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $userRole = $userAdmin->role;

        if($userAdmin->role == 'superuser'){
            $daftarPemilihan = Pemilihan::orderBy('id_fakultas', 'ASC')->get();
        }else if($userRole == 'admin fakultas'){
            $daftarPemilihan = Pemilihan::where('id_fakultas', $userAdmin->id_fakultas)
            ->orderBy('id', 'ASC')->get(); 
        }else{
            $daftarPemilihan = Pemilihan::where('id_admin', $userAdmin->id)
              ->orderBy('id', 'ASC')->get();
        }    

        // return response()->json($daftarPemilihan);

        return Datatables::of($daftarPemilihan)->make(true);
    }

    public static function findPemilihanByNPM(Request $request){
        $pemilih = Pemilih::where('npm', $request->npm)->first();
        $dptPemilihan = DPTPemilihan::where('id_pemilih', $pemilih->id)->get();
        $result = array();
        for($i = 0 ; $i < count($dptPemilihan);$i++){
            $result[$i]['id_pemilihan'] = $dptPemilihan[$i]->id_pemilihan;

            $pemilihan = Pemilihan::where('id', $dptPemilihan[$i]->id_pemilihan)->first();
            $result[$i]['nama_pemilihan'] = $pemilihan->nama;

        }        
        return Response::json(array('sesi_pemilihan' => $result));
    }

    //given npm, return election + candidate
    public function findByNPM(Request $request)
    {
        $npm = $request->npm;
        $pemilih = Pemilih::where('npm', $npm)->first();

        $result = array();
        $dptPemilihan = DPTPemilihan::select('id_pemilihan')->where('id_pemilih', $pemilih->id)->orderBy('id', 'ASC')->get();

        for($i = 0 ; $i < count($dptPemilihan);$i++){

            $result[$i]["id_pemilihan"] = $dptPemilihan[$i]->id_pemilihan;
            $pemilihan = Pemilihan::where('id', $dptPemilihan[$i]->id_pemilihan)->first();
            $result[$i]["nama_pemilihan"] = $pemilihan['nama'];
            $result[$i]['daftar_calon'] = Kandidat::select('no_urut', 'nama_ketua as nama_calon_ketua', 'path_foto_ketua as foto_calon_ketua', 'nama_wakil as nama_calon_wakil', 'path_foto_wakil as foto_calon_wakil')->where('id_pemilihan', $dptPemilihan[$i]->id_pemilihan)->orderBy('id', 'ASC')->get(); 
        }
        return Response::json(array('pemilihan' => $result));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm', $npm)->first();
        $npmNewAdmin = $request['npm_admin'];


        // $this->validate($request, [
        Validator::make($request, [
            'nama_pemilihan' => 'required|regex:/^[\pL\s\-]+$/u',
            'nama_admin' => 'required|regex:/^[\pL\s\-]+$/u',
            'npm_admin' => 'required|numeric|digits:10',
            'tanggal_mulai' => 'required|after_or_equal:today',
            'tanggal_selesai' => 'required|after_or_equal:tanggal_mulai'
        ]);

        $result = DB::transaction(function() use ($request, $userAdmin, $npmNewAdmin){
            //create admin first
            $newAdmin = new Admin();
            $newAdmin->username = $request['nama_admin'];
            $newAdmin->npm = $request['npm_admin'];
            $newAdmin->id_fakultas = $userAdmin->id_fakultas;
            $newAdmin->role = 'admin pemilihan';
            $newAdmin->save();

            $assignAdmin = Admin::where('npm', $npmNewAdmin)->first();
            $idAssignAdmin = $assignAdmin->id;
            $idFakultasAssignAdmin = $assignAdmin->id_fakultas;
            $namaPemilihan = $request['nama_pemilihan'];
            //assign admin to an election
            $newPemilihan = new Pemilihan();
            $newPemilihan->nama = $namaPemilihan;
            $newPemilihan->id_admin = $idAssignAdmin;
            $newPemilihan->id_fakultas = $idFakultasAssignAdmin;
            $newPemilihan->tanggal_mulai=  $request['tanggal_mulai'];
            $newPemilihan->tanggal_selesai= $request['tanggal_selesai'];
            $newPemilihan->save();
        });

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editByAdminFakultas(Request $request, $id)
    {
        $id_pemilihan = $request->id;
        $pemilihan = DB::table('daftar_pemilihan as dp')
                    ->join('daftar_admin as da', 'dp.id_admin', '=', 'da.id')
                    ->select('dp.id as id','da.username as nama_admin','da.npm as npm_admin' ,'dp.nama' , 'dp.tanggal_mulai', 'dp.tanggal_selesai')
                    ->where('dp.id', $id_pemilihan)
                    ->orderBy('dp.id', 'ASC')->get();       
        return response()->json($pemilihan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editByAdminPemilihan(Request $request)
    {
        $id_pemilihan = $request->id;
        $pemilihan = Pemilihan::where('id', $id_pemilihan)->get();
        return response()->json($pemilihan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        Validator::make($request, [
            'tanggal_mulai' => 'required|after_or_equal:today',
            'tanggal_selesai' => 'required|after_or_equal:tanggal_mulai'
        ]);
        $result = DB::transaction(function() use ($request){
            $update = Pemilihan::where('id', $id)->first();
            $update->nama = $request['nama'];
            $update->tanggal_mulai = $request['tanggal_mulai'];
            $update->tanggal_selesai = $request['tanggal_selesai'];
            $update->update();
        });
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pemilihan::find($id);
        $delete->delete();

        return response()->json($delete);
    }
}
