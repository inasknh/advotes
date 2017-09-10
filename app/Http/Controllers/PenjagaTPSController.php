<?php

namespace App\Http\Controllers; 

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\PenjagaTPS;
use App\Fakultas;
use App\Http\Controllers\LoginController;
use App\Admin;
use App\Pemilihan;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class PenjagaTPSController extends Controller
{
    //view untuk list penjaga tps
    public function index(Request $request) {
        $userAdmin = LoginController::getAdmin($request);
        $pageTitle = "Penjaga TPS";
        return view('penjagaTPS')->with(compact('userAdmin', 'pageTitle'));
    }

    //list penjaga tps 
    public function find(Request $request)
    {
        $fakultas = LoginController::getFakultas($request);
        $id_fakultas = $fakultas->id;
    
        $daftarPenjagaTPS = PenjagaTPS::where('id_fakultas',$id_fakultas)->orderBy('nama','ASC')->get();
        //dd($id_fakultas);
        // return response()->json($daftar_penjagaTPS);
        return Datatables::of($daftarPenjagaTPS)->make(true);
    }

    //simpan penjaga tps baru
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'npm' => 'required|numeric|digits:10|unique:daftar_penjaga_tps,npm',
            'imei' => 'required|numeric|digits:15|unique:daftar_penjaga_tps,imei',
        ]);

        $result = DB::transaction(function() use ($request){
            $fakultas = LoginController::getFakultas($request);
            $id_fakultas = $fakultas->id;

            $penjagaTPS = new PenjagaTPS();
            $penjagaTPS->nama = $request->nama;
            $penjagaTPS->npm = $request->npm;
            $penjagaTPS->imei = $request->imei;
            $penjagaTPS->id_fakultas = $id_fakultas;            
            $penjagaTPS->save();
        });

        return response()->json($result);
    }

    
    //view edit
    public function edit(Request $request)
    {
        $id_penjaga = $request->id;
        $penjagaTPS = PenjagaTPS::where('id', $id_penjaga)->get();
        return response()->json($penjagaTPS);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'npm' => ['required','numeric','digits:10',
                Rule::unique('daftar_penjaga_tps')->ignore($id),
            ],
            'imei' => ['required','numeric', 'digits:15',
                Rule::unique('daftar_penjaga_tps')->ignore($id),
            ],
        ]);
        $result = DB::transaction(function() use ($request, $id){
            $fakultas = LoginController::getFakultas($request);
            $id_fakultas = $fakultas->id;
        
            $penjagaTPS = PenjagaTPS::where('id', $id)
                            ->first();

            $penjagaTPS->nama = $request['nama'];
            $penjagaTPS->npm = $request['npm'];
            $penjagaTPS->imei = $request['imei'];
            $penjagaTPS->id_fakultas = $id_fakultas;
            $penjagaTPS->update();
        });
        return response()->json($result);
    }

    //delete spesifik penjaga tps
    public function destroy($id)
    {
        $penjagaTPS=PenjagaTPS::where('id', $id)->first()->delete();
        return response()->json($penjagaTPS);
    }

}
