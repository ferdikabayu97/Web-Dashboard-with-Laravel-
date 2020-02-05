<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use PDF;
use App\UMKM;
use App\Exports\UMKMExport;
use App\Imports\UMKMImport;
use Maatwebsite\Excel\Facades\Excel;

class UMKMController extends Controller
{
    public function index(Request $request)
    {
		$jenis = $request->kriteria;
		
    	// mengambil data dari table pegawai
    	$UMKM = UMKM::orderByRaw('no + 0 asc')->where('jenis_usaha','like',"%".$jenis."%")->paginate(10)->appends('kriteria',$jenis);
    	$ju = DB::table('alternatif')->get();
        session()->flashInput($request->input());
		
		// mengirim data pegawai ke view index
		$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
			$nilai = array();
			foreach($ju as $j){
				$nilai[] =  UMKM::where('jenis_usaha','like',"%".$j->nama_alternatif."%")->count();
			}
		return view('umkm',['umkm' => $UMKM,'ju' => $ju,'nilai' => $nilai]);
 
	}
	public function kategori(Request $request)
    {

        $jenis = $request->kriteria;
		// dd($jenis);
        session()->flashInput($request->input());
    	$ju = DB::table('alternatif')->get();		
    	$UMKM = UMKM::orderByRaw('no + 0 asc')->where('jenis_usaha','like',"%".$jenis."%")->paginate(10)->appends('kriteria',$jenis);
        $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}$nilai = array();
			foreach($ju as $j){
				$nilai[] =  UMKM::where('jenis_usaha','like',"%".$j->nama_alternatif."%")->count();
			}
		return view('umkm',['umkm' => $UMKM,'ju' => $ju,'nilai' => $nilai]);
    }
	
	public function add(Request $request)
{
	// $this->validate($request,[
	// 	'nama_pemilik'=> 'required',
	// 	'jenis_usaha'=> 'required',
	// 	'jumlah'=> 'required|numeric',
	// 	'aset' => 'required|numeric',
    // 	'omset'=> 'required|numeric',
	// 	'kelurahan'=> 'required',
	// 	'kecamatan'=> 'required',
	// 	'ket'=> 'required'
    //     ]);

	// memanggil view tambah
	$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
	return view('addUMKM');
 
}
public function store(Request $request)
{$id = $request->session()->get('id');
	if($id ==""){
		return redirect('/');	
		}
	$admin = $request->session()->get('id');;
	$count = UMKM::count()+1;
	$countother = DB::table('table_idx')->count()+1;
	$bool = UMKM::where('no',$count)->exists();
	while($bool){
		$count = $count+1;
        session()->flashInput($request->input());

	$bool = UMKM::where('no',$count)->exists();
	};
	// insert data ke table pegawai
	UMKM::insert([
	
	'no' => $count,
	'nama_perusahaan' => $request->namaper,
	'nama_pemilik'=> $request->namapem,
	'alamat'=> $request->alamat,
    'telp'=> $request->telp,
	'jenis_usaha'=> $request->ju,
	'jumlah'=> $request->jumb,
	'aset' => $request->aset,
    'omset'=> $request->omset,
	'kelurahan'=> $request->kel,
	'kecamatan'=> $request->kec,
	'tahun'=> $request->tahun,
	'ket'=> $request->ket,
	'idx_table' => $countother
		]);

	DB::table('log_edit')->insert([
		'idx_table' => $countother,
		'id_admin' => $admin,
		'log' => now(),
		'tabel' => "UMKM",
		'event' => "Insert",
		'kunci' => $count
	]);
	// alihkan halaman ke halaman pegawai
	Alert::success('Silahkan lihat datamu', 'Data '.$count.' Berhasil ditambahkan')->autoclose(3000);
	
	return redirect('/umkm');
 
}
// method untuk edit data pegawai
public function edit(Request $request, $no)
{$id = $request->session()->get('id');
	if($id ==""){
		return redirect('/');	
		}
	// mengambil data pegawai berdasarkan id yang dipilih
	$dataUMKM = UMKM::where('no',$no)->get();
	// passing data pegawai yang didapat ke view edit.blade.php
	return view('editUMKM',['dataUMKM' => $dataUMKM]);
 
}
// update data pegawai
public function update(Request $request)
{$id = $request->session()->get('id');
	if($id ==""){
		return redirect('/');	
		}
	$admin = $request->session()->get('id');;

	// update data pegawai
	$idx = DB::table('UMKM')->select('idx_table')->where('no',$request->no)->first();
	DB::table('UMKM')->where('no',$request->no)->update([
	'nama_perusahaan' => $request->namaper,
	'nama_pemilik'=> $request->namapem,
	'alamat'=> $request->alamat,
    'telp'=> $request->telp,
	'jenis_usaha'=> $request->ju,
	'jumlah'=> $request->jumb,
	'aset' => $request->aset,
    'omset'=> $request->omset,
	'kelurahan'=> $request->kel,
	'kecamatan'=> $request->kec,
	'tahun'=> $request->tahun,
	'ket'=> $request->ket
	]);

	DB::table('log_edit')->insert([
		'idx_table' => $idx->idx_table,
		'id_admin' => $admin,
		'log' => now(),
		'tabel' => "UMKM",
		'event' => "update",
		'kunci' => $request->no
	]);
	Alert::success('Silahkan lihat datamu', 'Edit Data '.$request->no.' Berhasil')->autoclose(3000);
	
		
	
	// alihkan halaman ke halaman pegawai
	return redirect('/umkm');
}
public function delete(Request $request, $no)
{$id = $request->session()->get('id');
	if($id ==""){
		return redirect('/');	
		}
	$admin = $request->session()->get('id');;
	$idx = DB::table('UMKM')->select('idx_table')->where('no',$no)->first();
	// menghapus data pegawai berdasarkan id yang dipilih
	UMKM::where('no',$no)->delete();
		
	DB::table('log_edit')->insert([
		'idx_table' => $idx->idx_table,
		'id_admin' => $admin,
		'log' => now(),
		'tabel' => "UMKM",
		'event' => "delete",
		'kunci' => $no
	]);
	// alihkan halaman ke halaman pegawai
	Alert::success('Silahkan lihat datamu', 'Data '.$no.' Berhasil dihapus')->autoclose(3000);
	
	return redirect('/umkm');
}
public function search(Request $request)
	{$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
		// menangkap data pencarian
		$search = $request->search;
    	$ju = DB::table('alternatif')->get();		
        $jenis = $request->jenis;
        session()->flashInput($request->input());
        // dd($request->cari);
        $cari = $request->cari;
        if($cari == ""){
            $cari = "nama_pemilik";        
        }
    		// mengambil data dari table pegawai sesuai pencarian data
		$umkm = UMKM::where('jenis_usaha','like',"%".$jenis."%")->where($cari,'like',"%".$search."%")->orderByRaw('no + 0  asc')->paginate(10)->appends(['cari' => $cari,'kriteria' => $jenis]);
		
			// mengirim data pegawai ke view index
			$nilai = array();
			foreach($ju as $j){
				$nilai[] =  UMKM::where('jenis_usaha','like',"%".$j->nama_alternatif."%")->count();
			}
		return view('umkm',['umkm' => $umkm,'ju' => $ju,'nilai' => $nilai]);
 
	}
	public function cetak_pdf(Request $request)
{
    $umkm = UMKM::all();
    
	$pdf = PDF::loadview('umkm_pdf',['umkm'=>$umkm]);
	$pdf->setPaper('A4', 'landscape');
    return $pdf->stream();
    // return view('penduduk_pdf',['penduduk'=>$penduduk],['jenis'=>$jenis]);
}
public function export_excel()
{
	return Excel::download(new UMKMExport, 'umkm.xlsx');
}

public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_upload',$nama_file);
 
		// import data
		Excel::import(new UMKMImport, public_path('../../admin/file_upload/'.$nama_file));
 
		// notifikasi dengan session
		Alert::success('Silahkan lihat datamu', 'Upload data sukses')->autoclose(3000);
		
		// alihkan halaman kembali
		return redirect('/umkm');
	}

}
