<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenjagaTPS;
use App\Fakultas;
use App\Http\Controllers\LoginController;
use App\Admin;
use App\Kandidat;
use App\Pemilihan;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{

    public function index(Request $request)
    {
        $userAdmin = LoginController::getAdmin($request);
        
        $id_fakultas = $userAdmin->id_fakultas;
        $id_admin = $userAdmin->id;
        $page_title = "Kandidat";

        $daftar_pemilihan = Pemilihan::where('id_admin', $id_admin)
            ->get();
        $semua_pemilihan = Pemilihan::where('id_fakultas', $id_fakultas)
                          ->orderBy('nama', 'ASC')
                          ->get();
        $pageTitle = "Kandidat";
        return view('kandidat')->with(compact('userAdmin', 'daftar_pemilihan', 'pageTitle', 'semua_pemilihan'));
    }


    public function listPerPemilihan(Request $request)
    {

        $id_pemilihan = $request->id;
        $daftar_kandidat = Kandidat::where('id_pemilihan', $id_pemilihan)->get();
        //dd($daftar_kandidat);
        return response()->json($daftar_kandidat);

    }

    public function listKandidat(Request $request)
    {

        $id_pemilihan = $request->id;
        $no_urut = $request->no_urut;
        $kandidat = Kandidat::where('id_pemilihan', $id_pemilihan)->where('no_urut', $no_urut)->first();

        return response()->json($kandidat);
    }

    public function store(Request $request, $id_pemilihan)
    {
        $this->validate($request, [
            'no_urut'=>'required|numeric',
            'nama_ketua'=>'required|regex:/^[\pL\s\-]+$/u',
            'npm_ketua'=>'required|numeric|unique:daftar_kandidat,npm',
            'path_foto_ketua'=>'required',
            'nama_wakil'=>'nullable|regex:/^[\pL\s\-]+$/u',
            'npm_wakil'=>'nullable|numeric|unique:daftar_kandidat,npm'
        ]);

        $kandidat = new Kandidat();

        $kandidat->id_pemilihan = $id_pemilihan;
        $kandidat->no_urut = $request->no_urut;
        $kandidat->nama_ketua = $request->nama_ketua;
        $kandidat->nama_wakil = $request->nama_wakil;
        $kandidat->npm_ketua = $request->npm_ketua;
        $kandidat->npm_wakil = $request->npm_wakil;

        $pemilihan = Pemilihan::find($kandidat->id_pemilihan);

        if($request->hasFile('path_foto_ketua')) {
            $file = $request->file('path_foto_ketua');
            $nama = $pemilihan->nama.'-'.$request->no_urut.'-'.$request->nama_ketua.'.jpg';
            $kandidat->path_foto_ketua = $nama;
            $file->move(public_path().'/images/candidates', $nama);
        }
        if($request->hasFile('path_foto_wakil')){
            $file = $request->file('path_foto_wakil');
            $nama = $pemilihan->nama.'-'.$request->no_urut.'-'.$request->nama_wakil.'.jpg';
            $kandidat->path_foto_wakil = $nama;
            $file->move(public_path().'/images/candidates', $nama);
        }
        $kandidat->save();

        return response()->json($kandidat);

    }

    public function update(Request $request, $id_pemilihan, $no_urut)
    {
       $this->validate($request, [
            'no_urut'=>'required|numeric',
            'nama_ketua'=>'required|regex:/^[\pL\s\-]+$/u',
            'npm_ketua'=> ['required', 'numeric',
                Rule::unique('daftar_kandidat')->ignore($id),
            ],
            'path_foto_ketua'=>'required',
            'nama_wakil'=>'nullable|regex:/^[\pL\s\-]+$/u',
            'npm_wakil'=> ['nullable', 'numeric',
                Rule::unique('daftar_kandidat')->ignore($id),
            ],
        ]);

       $kandidat = Kandidat::where('id_pemilihan', $id_pemilihan)
                    ->where('no_urut', $no_urut)
                    ->first();

        $kandidat->id_pemilihan = $id_pemilihan;
        $kandidat->no_urut = $request['no_urut'];
        $kandidat->nama_ketua = $request['nama_ketua'];
        $kandidat->npm_ketua = $request['npm_ketua'];
        $kandidat->nama_wakil = $request['nama_wakil'];

        $pemilihan = Pemilihan::find($kandidat->id_pemilihan);

        if($request->hasFile('path_foto_ketua')) {
            $file = $request->file('path_foto_ketua');
            $nama = $pemilihan->nama.'-'.$request->no_urut.'-'.$request->nama_ketua.'.jpg';
            $kandidat->path_foto_ketua = $nama;
            $file->move(public_path().'/images/candidates',$nama);
        }
        if($request->hasFile('path_foto_wakil')) {
            $file = $request->file('path_foto_wakil');
            $nama = $pemilihan->nama.'-'.$request['no_urut'].'-'.$request['nama_wakil'].'.jpg';
            $kandidat->path_foto_wakil = $nama;
            $file->move(public_path().'/images/candidates',$nama);
        }

        $kandidat->save();
        return response()->json($kandidat);

    }


    public function destroy($id_pemilihan, $no_urut)
    {
        $kandidat = Kandidat::where('id_pemilihan', $id_pemilihan)
            ->where('no_urut', $no_urut)
            ->first();

        $kandidat->delete();

        return response()->json($kandidat);
    }
}
