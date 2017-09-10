<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Pemilihan;
use App\Kandidat;
use App\Pemilih;
use App\DPTPemilihan;
use App\Fakultas;
use DB;
use Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Facades\Datatables;
use Input;
use App\Http\Controllers\Controller;
use PrakashDivy\Laravel\OAuth2\UI\Facades\UI;
use Excel;

class PemilihController extends Controller
{
    public function index(Request $request) {
        $pageTitle = "Daftar Pemilih Tetap";
        $npm = LoginController::getNPM($request);

        $userAdmin = Admin::where('npm',$npm)->first();
         if($userAdmin->role == 'superuser'){
            $daftarPemilihan = Pemilihan::orderBy('id_fakultas', 'ASC')->get();
        }else if($userAdmin->role == 'admin fakultas'){
             $daftarPemilihan = Pemilihan::where('id_fakultas', $userAdmin->id_fakultas)
             ->orderBy('id', 'ASC')->get(); 
        }else{
            $daftarPemilihan = Pemilihan::where('id_admin', $userAdmin->id)
              ->orderBy('id', 'ASC')->get();
        }

        return view('listPemilih')->with(compact('pageTitle', 'userAdmin', 'daftarPemilihan'));

    }

    //list dpt per 
    public function find(Request $request)
    {
        $idPemilihan = $request->id;
        $daftarDPT = Pemilih::whereIn('id', function($query) use ($idPemilihan){
            $query->select('id_pemilih')->from('daftar_dpt_pemilihan')
            ->whereIn('id_pemilihan', explode(',', $idPemilihan));
        })->orderBy('nama', 'ASC')->get();

        return Datatables::of($daftarDPT)->make(true);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $id_pemilihan = $request->id_pemilihan;

        $voter = Pemilih::whereIn('id', function($query) use ($id_pemilihan){
             $query->select('id_dpt')->from('daftar_dpt_pemilihan')
             ->whereIn('id_pemilihan', explode(',', $id_pemilihan));
        })->where(function ($query) use ($keyword){
            $query->where("nama", "ILIKE", "%$keyword%")
            ->orWhere("npm", "ILIKE", "%$keyword%");
        })
        ->orderBy($request->sort, 'ASC')->get();
        return response()->json($voter);

    }

    public function add($id_pemilihan, Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm', $npm)->first();

        $pemilihan = PemilihanController::findPemilihanById($id_pemilihan);
        return view('addManual')->with(compact('pemilihan','user', 'userAdmin'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'npm' => 'required|unique:daftar_pemilih,npm|numeric|digits:10'
        ]);

        $result = DB::transaction(function() use ($request){
            if(!Pemilih::where('npm', $request->npm)->exists()){
                $pemilih = new Pemilih();
                $pemilih->nama = $request['nama'];
                $pemilih->npm = $request['npm'];
                $pemilih->save();
            }
            
            $pemilih = Pemilih::where('npm', $request->npm)->first();
            $idPemilihan = $request->id;       
            $DPTPemilihan = new DPTPemilihan();
            $DPTPemilihan->id_pemilihan = $idPemilihan;
            $DPTPemilihan->id_pemilih = $pemilih->id;
            $DPTPemilihan->save();
        });

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request)
    {
        $id_pemilih = $request->id;
        $pemilih = Pemilih::where('id', $id_pemilih)->get();
        return response()->json($pemilih);
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
        $this->validate($request, [
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'npm' => ['required', 'numeric','digits:10',
                    Rule::unique('daftar_pemilih')->ignore($id),
            ]
         ]);

        $result = DB::transaction(function() use ($request, $id){
            $update = Pemilih::where('id',$id)->first();
            $update->id = $id;
            $update->nama = $request['nama'];
            $update->npm = $request['npm'];
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
    public function destroy(Request $request)
    {
        $result = DB::transaction(function() use ($request){
            $id = $request->id;
            $idPemilihan = $request->idPemilihan;
            $DPTPemilihan = DPTPemilihan::where('id_pemilih',$id)
                            ->where('id_pemilihan', $idPemilihan)->delete();
        });
        return response()->json($result);
    }

    public function importExcel(Request $request)
    {
        $result = DB::transaction(function() use ($request){
            $id = $request->id;
            // echo $request."\n";
            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();
                // echo $path+"\n";
                $data = Excel::load($path)->get();
                // echo $data;
                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if (!Pemilih::where('npm', $value->npm)->exists()) {
                            $insert = ['nama' => $value->nama, 'npm' => $value->npm];
                            Pemilih::insert($insert);
                        }

                        $pemilih = Pemilih::select('id')->where('npm', $value->npm)->first();
                        // if(!DPTPemilihan::where('id_pemilihan', $id)->where('id_pemilih', $pemilih->id)->exists()){
                            $dptPemilihan = ['id_pemilihan' => $id, 'id_pemilih'=> $pemilih->id];
                            DPTPemilihan::insert($dptPemilihan);
                        // }
                    }

                }
            }
        });
        return response()->json($result);
    }

    public function downloadExample()
    {
        $headers=["Content-Type"=> "application/vnd.ms-excel"];
        return response()->download("files/template-contoh.xlsx","Template-contoh.xlsx", $headers);
    }

    public function downloadTemplate()
    {
        $headers=["Content-Type" => "application/vnd.ms-excel"];
        return response()->download("files/template.xlsx","Template.xlsx", $headers);
    }

}
