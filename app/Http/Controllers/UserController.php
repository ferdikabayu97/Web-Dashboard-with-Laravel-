<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use PDF;
use App\User_id;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
class UserController extends Controller
{
    public function index(Request $request)
    {$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
        session()->flashInput($request->input());
		$Userstatus = User_id::distinct()->get(['active_status']);
    	// mengambil data dari table pegawai
		$User = User_id::paginate(10);
// dd($Userstatus);
 
    	// mengirim data pegawai ke view index
    	return view('user',['user' => $User],['User' => $User]);
 
	}

	public function kategori(Request $request)
    {$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}

        $jenis = $request->kriteria;
		// dd($jenis);
        session()->flashInput($request->input());		
    	$User = User_id::paginate(10);
		$user = User_id::where('active_status','=',$jenis)->paginate(10);
    	return view('user',['user' => $user],['User' => $User]);
    }
public function delete(Request $request, $id_user)
{$id = $request->session()->get('id');
	if($id ==""){
		return redirect('/');	
		}
    $admin = $request->session()->get('id');
	$idx = DB::table('User_id')->select('idx_table')->where('id_user',$id_user)->first();
	// menghapus data pegawai berdasarkan id yang dipilih
	User_id::where('id_user',$id_user)->delete();
        
    DB::table('log_edit')->insert([
		'idx_table' => $idx->idx_table,
		'id_admin' => $admin,
		'log' => now(),
		'tabel' => "User_id",
		'event' => "delete",
		'kunci' => $id_user
	]);
	// alihkan halaman ke halaman pegawai
	Alert::success('Silahkan lihat datamu', 'Data '.$id_user.' Berhasil dihapus')->autoclose(3000);

	return redirect('/user');
}
public function search(Request $request)
	{$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
		// menangkap data pencarian
        session()->flashInput($request->input());

		$search = $request->search;
        $jenis = $request->jenis;
		$cari = $request->cari;
        if($cari == ""){
            $cari = "id_user";        
        } 
    		// mengambil data dari table pegawai sesuai pencarian data
		$user = User_id::where('active_status','=',$jenis)->where($cari,'like',"%".$search."%")->paginate(10);
    	$User = User_id::paginate(10);
 
    		// mengirim data pegawai ke view index
		return view('user',['user' => $user],['User' => $User]);
 
	}
	public function cetak_pdf(Request $request, $jenis)
	{
		$user = User_id::where('active_status','=',$jenis)->get();
		
		$pdf = PDF::loadview('user_pdf',['user'=>$user],['jenis'=>$jenis]);
		return $pdf->stream();
		// return view('user_pdf',['user'=>$user]);
	}
	public function export_excel()
	{
		return Excel::download(new UserExport, 'pengguna.xlsx');
	}
}
