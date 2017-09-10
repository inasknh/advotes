<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;
use App\Admin;
use App\Pemilihan;
use App\Fakultas;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Session;
use PrakashDivy\Laravel\OAuth2\UI\Facades\UI;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
     public function findAllAdmin(Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $userRole = $userAdmin->role;
        $daftarAdminFakultas;
        $adminPemilihanRole = 'admin pemilihan';

        if($userRole == "superuser"){
            $daftarAdmin = DB::table('daftar_admin as da')
                ->join('daftar_fakultas as df', 'da.id_fakultas', '=', 'df.id')
                ->select('da.id as id_admin', 'da.username', 'da.npm', 'df.name as fakultas_name')
                ->orderBy('da.id', 'ASC')->get();
        }else{
            $daftarAdmin = DB::table('daftar_admin as da')
                ->join('daftar_fakultas as df', 'da.id_fakultas', '=', 'df.id')
                ->join('daftar_pemilihan as dp', 'da.id', '=', 'dp.id_admin')
                ->select('da.id as id_admin', 'da.username', 'da.npm', 'df.name as fakultas_name', 'dp.nama as pemilihan_name')
                ->where('da.role', $adminPemilihanRole)
                ->where('df.id', $userAdmin->id_fakultas)
                ->orderBy('da.id', 'ASC')->get();
        }
        // return response()->json($daftarAdmin);//then sent this data to ajax success
        return Datatables::of($daftarAdmin)->make(true);
    }

    public function faq(Request $request){    
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $pageTitle = "Forum Answer & Question";
        return view('faq')->with(compact('user', 'userAdmin', 'pageTitle'));
    }

    public function addAdminFakultas(Request $request){
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $daftarFakultas = Fakultas::orderBy('id', 'ASC')->get();
        $pageTitle = "Tambah Admin Fakultas";
        $message = "";
        return view('addAdminFakultas')->with(compact('pageTitle', 'userAdmin', 'daftarFakultas', 'message'));
    }

   /**
     * Display a listing of the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $npm = LoginController::getNPM($request);
        $userAdmin = Admin::where('npm',$npm)->first();
        $userRole = $userAdmin->role;

        if($userRole == "superuser"){
            $daftarAdmin = Admin::orderBy('id', 'ASC')->get();
        }else{
            $daftarAdmin = Admin::where('id_fakultas', $userAdmin->id_fakultas)->orderBy('id', 'ASC')->get();    
        }
        
        $daftarPemilihan = Pemilihan::orderBy('id', 'ASC')->get();
        $daftarFakultas = Fakultas::orderBy('id', 'ASC')->get();
        $pageTitle = "Admin";

        return view('listAdmin')->with(compact('daftarAdmin', 'daftarFakultas', 'daftarPemilihan', 'user', 'userAdmin','message', 'pageTitle'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:daftar_admin',
            'fakultas' => 'required',
            'npm' => 'required|unique:daftar_admin,npm|numeric|digits:10'
        ]); 
        $result = DB::transaction(function() use ($request){
            $npm = $request['npm'];
            $username = $request['username'];
            $admin1 = Admin::where('npm', $npm)->orWhere('username', $username)->get();
            $message = "";
            if($admin1 == null){
                $admin = new Admin();
                $admin->username = $request['username'];
                $admin->npm = $request['npm'];
                $admin->id_fakultas = $request['fakultas'];
                $admin->role = 'admin fakultas';
                $admin->save();
            }
        });
        return response()->json($result);
    }

    public function edit(Request $request){
        $id_admin = $request->id;
        $admin = Admin::where('id', $id_admin)->get();
        return response()->json($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdminFakultas(Request $request, $id)
    {
        $result = DB::transaction(function() use ($request, $id){
            $npm = LoginController::getNPM($request);
            $userAdmin = Admin::where('npm',$npm)->first();
            $userRole = $userAdmin->role;

            if($userRole == 'superuser'){
                $this->validate($request, [
                    'username' => ['required' ,
                        Rule::unique('daftar_admin')->ignore($id),
                    ],
                    'npm' => ['required', 'numeric','digits:10',
                        Rule::unique('daftar_admin')->ignore($id),
                    ]
                ]);    

                $update = Admin::where('id', $id)->first();
                $update->username = $request['username'];
                $update->id_fakultas = $request['fakultas'];
                $update->save();
            }else if($userRole == 'admin fakultas'){
                $this->validate($request, [
                    'username' => ['required' ,
                        Rule::unique('daftar_admin')->ignore($id),
                    ],
                    'npm' => ['required', 'numeric','digits:10',
                        Rule::unique('daftar_admin')->ignore($id),
                    ]
                ]); 
                // $messages = [
                //     'username.unique' => 'Username ' + $request->username +' sudah terdaftar',
                //     'npm.unique' => 'NPM ' + $request->npm + ' sudah terdaftar',
                //     'npm.numeric' => 'NPM harus angka',
                //     'npm.digits' => 'NPM terdiri dari 10 digit',
                // ];

                $update = Admin::where('id', $id)->first();
                $update->username = $request['username'];
                $update->npm = $request['npm'];
                $update->save();
            }
        });
        return response()->json($result, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = DB::transaction(function() use ($request, $id){
            $idAdmin = $id;
            $npm = LoginController::getNPM($request);
            $userAdmin = Admin::where('npm',$npm)->first();

            $pemilihan = Pemilihan::where('id_admin', $idAdmin)->first();
            $pemilihan->id_admin = $userAdmin->id;
            $pemilihan->save();

            $delete = Admin::find($idAdmin);
            $delete->delete();
        });
        return response()->json($result);
    }

}
