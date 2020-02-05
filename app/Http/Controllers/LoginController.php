<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Alert;
use Cookie;
use App\Admin;

class LoginController extends Controller
{
    public function index(Request $request)
    {

    	// mengambil semua data pengguna
        // return data ke view
        // dd($penduduk->jk->pria);
        $id = $request->id;
        session()->flashInput($request->input());
        $pass = $request->pass;
        $bool = Admin::where('id_admin',$id)->where('password',$pass)->exists();
        if($bool){
            if($request->remember_me == "true"){
                
                Cookie::queue('username', $id, 2628000);
                Cookie::queue('password', $pass, 2628000);
                   
            }
            $request->session()->put('id',$id);
            return redirect('/umkm');
            
        }else{
            Alert::error('Silahkan periksa data login anda','Login Gagal')->autoclose(3000);
            return redirect('/');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('id');
        
        return redirect('/');
        
        
    }
    public function gantipass(Request $request)
    {
        $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    	return view('gantipass');
        
    }
    public function storepass(Request $request)
    {

        $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    	$pass1 = $request->oldpass;
        $pass2 = $request->newpass;
        $pass3 = $request->confpass;
        if($pass3 != $pass2){
        session()->flashInput($request->input());

            Alert::error('Password baru dan konfirmasi berbeda','Ganti Password Gagal')->autoclose(3000);
            return redirect()->back();
        }
        $bool = DB::table('admin')->where('id_admin',$id)->where('password',$pass1)->exists();
        if(!$bool){
        session()->flashInput($request->input());

            Alert::error('Password lama anda salah','Ganti Password Gagal')->autoclose(3000);
            return redirect()->back();
        }
        if($pass1 === $pass2){
        session()->flashInput($request->input());

            Alert::error('Password lama dan baru sama','Ganti Password Gagal')->autoclose(3000);
            return redirect()->back();
        } 
        DB::table('admin')->where('id_admin',$id)->update([
            'password' => $pass2
        ]);
        Alert::success('Password baru diterapkan','Ganti Password Sukses')->autoclose(3000);

        return redirect()->back();
        
    }
    
}
