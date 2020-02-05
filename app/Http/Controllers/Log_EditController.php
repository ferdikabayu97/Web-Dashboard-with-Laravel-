<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Log_Edit;
use Alert;
use App\Exports\Log_editExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class Log_EditController extends Controller
{
    public function index(Request $request)
    {
        session()->flashInput($request->input());
    	// mengambil data dari table pegawai
    	$logedit = Log_Edit::orderByRaw('log desc')->paginate(10);
 
		// mengirim data pegawai ke view index
		$id = $request->session()->get('id');
		if($id ==""){
		return redirect('/');	
		}
    	return view('logedit',['logedit' => $logedit]);
 
	}

public function search(Request $request)
	{
		// menangkap data pencarian
		$search = $request->search;
        session()->flashInput($request->input());
		$cari = $request->cari;
        if($cari == ""){
            $cari = "tabel";        
        }
    		// mengambil data dari table pegawai sesuai pencarian data
		$logedit = Log_Edit::where($cari,'like',"%".$search."%")->orderByRaw('log desc')->paginate(10);
		$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    		// mengirim data pegawai ke view index
		return view('logedit',['logedit' => $logedit]);
 
	}
	public function cetak_pdf(Request $request)
{
    $logedit = Log_Edit::all();
    
    $pdf = PDF::loadview('logedit_pdf',['logedit'=>$logedit]);
    return $pdf->stream();
    // return view('penduduk_pdf',['penduduk'=>$penduduk],['jenis'=>$jenis]);
}
public function export_excel()
{
	return Excel::download(new Log_editExport, 'logedit.xlsx');
}
}
