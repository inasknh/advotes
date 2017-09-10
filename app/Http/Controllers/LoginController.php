<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Fakultas;
use App\Pemilihan;
use App\Http\Controllers\Controller;
use PrakashDivy\Laravel\OAuth2\UI\Facades\UI;

class LoginController extends Controller
{
    public function index() {
        return view('signin');
    }

    public function logout (Request $request) {
        if($request->session()->has('data')) {
            $request->session()->flush();
            
            if(!$request->session()->has('data')) {
                //echo "logout";
                return redirect()->to('/');
            }
        }
        if($request->session()->has('npmDummy')){
            $request->session()->flush();
            if(!$request->session()->has('npmDummy')) {
                //echo "logout";
                return redirect()->to('/');
            }
        }
    }

 	public function store(Request $request) {

        $validator = Validator::make($request->all(), [
          'username' => 'required',
          'password' => 'required'
        ]);

        if($validator->fails()){
            $messages = $validator->messages();
             return redirect()->to('')->withErrors($validator);
        }else{
            $username = $request['username'];
            $password = $request['password'];

            if ($username == "gemastik.fakultas" && $password == "gemastikfakultas") {
                $userLogin = Admin::where('username', $username)->first();
                if($userLogin != null){
                    $request->session()->put('npmDummy', '1029384756');
                    return redirect()->to('dashboard');
                }
            } else if($username == "gemastik.pemilihan" && $password == "gemastikpemilihan"){
                $userLogin = Admin::where('username', $username)->first();
                if($userLogin != null){
                    $request->session()->put('npmDummy', '0192837465');
                    return redirect()->to('dashboard');
                }
            }else {
                try {
                    $accessToken = UI::getAccessToken('password',[
                        'username' => $username,
                        'password' => $password
                    ]);

                    $admin=Admin::where('username', 'ilike', $username)->first();

                    $data = UI::getResourceOwner($accessToken);
                    
                    if(is_null($admin)) {
                        $messages = "Anda tidak terdaftar sebagai admin";
                        return redirect()->to('')->with('error', $messages);
                    } else {
                        if($admin->npm == $data->getNPM()){
                            $request->session()->put('data',$data);
                            return redirect()->to('dashboard/');
                        }
                    }
                }
                catch(\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                    $messages = "Anda tidak memiliki akses";
                    return redirect()->to('')->with('error', $messages);
                } 
            }
            
        }
    }

    public static function getUser(Request $request) {
        $user = $request->session()->get('data');
        return $user;
    }
    
    public static function getNPM(Request $request) {
        if($request->session()->has('npmDummy')){
            $npm = $request->session()->get('npmDummy');
        }else {
            $user = $request->session()->get('data');
            $npm = $user->getNPM();
        }
        return $npm;
    }

    public static function getProdi(Request $request) {
        $user = $request->session()->get('data');
        $prodi = $user->getProdi();

        return $prodi;
    }

    public static function getFakultas(Request $request) {
        $npm = LoginController::getNPM($request);
        $id = Admin::select('id_fakultas')
                        ->where('npm', $npm)
                        ->first()
                        ->id_fakultas;
          
        $fakultas = Fakultas::where('id',$id)->first();

        return $fakultas;
    }

    public static function getIdPemilihan(Request $request) {
        $admin = LoginController::getAdmin($request);
        $id = $admin->id;
        $id_pemilihan = Pemilihan::select('id')
                        ->whereIn('id_admin', $id)
                        ->get();

        return $id_pemilihan;
    }

    public static function getAdmin(Request $request) {
        $npm = LoginController::getNPM($request);
        $admin = Admin::where('npm', $npm)
                        ->first();
        return $admin;
   }

}
