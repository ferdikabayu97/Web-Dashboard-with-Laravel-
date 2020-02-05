<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Alert;
use PDF;
use App\Data_kode_lokasi;
use App\Exports\Data_kode_lokasiExport;
use App\Exports\JkExport;
use App\Exports\SkExport;
use App\Exports\PekerjaanExport;
use App\Exports\PendidikanExport;
use App\Exports\UmurExport;

use App\Imports\Data_kode_lokasiImport;
use App\Imports\JkImport;
use App\Imports\SkImport;
use App\Imports\PekerjaanImport;
use App\Imports\PendidikanImport;
use App\Imports\UmurImport;


use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        session()->flashInput($request->input());
        
        $jenisb = $request->kriteria;
        if($jenisb === null){
            $jenis = "jk";
            
        } else {$jenis = $jenisb;}
        $chart = Data_kode_lokasi::orderByRaw('id_lokasi + 0 asc')->get();
        $lenght = DB::table('jk')->count('pria');
        if ($request->chart > $lenght){
            Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
			return redirect()->back();	

        }
        $penduduk = Data_kode_lokasi::orderByRaw('id_lokasi + 0 asc')->paginate(10)->appends('kriteria',$jenis);
        $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    	return view('penduduk', ['jenis' => $jenis],['chart' => $chart, 'penduduk' => $penduduk]);
    }

    public function kategori(Request $request)
    {
        session()->flashInput($request->input());
        $jenisb = $request->kriteria;
        if($jenisb === null){
            $jenis = "jk";
            
        } else {$jenis = $jenisb;}
        $chart = Data_kode_lokasi::orderByRaw('id_lokasi + 0 asc')->get();
        $lenght = DB::table('jk')->count('pria');
        if ($request->chart > $lenght){
            Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
			return redirect()->back();	

        }
        // dd($jenis);
    	$penduduk = Data_kode_lokasi::orderByRaw('id_lokasi + 0 asc')->paginate(10)->appends('kriteria',$jenis);
        $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    	return view('penduduk', ['jenis' => $jenis], ['chart' => $chart, 'penduduk' => $penduduk]);
    }
    public function search(Request $request)
	{
               session()->flashInput($request->input());
               // menangkap data pencarian
		$search = $request->search;
        $jenis = $request->jenis;
        $chart = Data_kode_lokasi::orderByRaw('id_lokasi + 0 asc')->get();
        $lenght = DB::table('jk')->count('pria');
        if ($request->chart > $lenght){
            Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
			return redirect()->back();	

        }

        session()->flashInput($request->input());
        // dd($request->cari);
        $cari = $request->cari;
        if($cari == ""){
            $cari = "kecamatan";        
        }
    		// mengambil data dari table pegawai sesuai pencarian data
		$penduduk = Data_kode_lokasi::where($cari,'like',"%".$search."%")->orderByRaw('id_lokasi + 0 asc')->paginate(10)->appends(['cari' => $cari,'jenis' => $jenis]);
 
            // mengirim data pegawai ke view index
            $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
		return view('penduduk',['jenis' => $jenis],['chart' => $chart, 'penduduk' => $penduduk]);
 
    }
    
    public function add(Request $request)
{
	// $this->validate($request,[
	// 	'nama_pemilik'=> 'required',
	// 	'jenis_usaha'=> 'required',
               session()->flashInput($request->input());
               // 	'jumlah'=> 'required|numeric',
	// 	'aset' => 'required|numeric',
    // 	'omset'=> 'required|numeric',
	// 	'kelurahan'=> 'required',
	// 	'kecamatan'=> 'required',
	// 	'ket'=> 'required'
    //     ]);
    $res = array();
    $res['kec'] = "";
    // memanggil view tambah
    $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
	return view('addPenduduk',['res' => $res]);
 
}
public function addKriteria(Request $request)
{
               session()->flashInput($request->input());
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
    $res = array();
    $res['kel'] = $request->kelurahan;
    $res['kec'] = $request->kecamatan;
    $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
    if($res['kel'] != ""){
	// memanggil view tambah
	return view('addPendudukKriteria',['res' => $res]);
    }else{
	return view('addPenduduk',['res' => $res]);
    }
}
public function store(Request $request)
{
    $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
	$admin = $request->session()->get('id');
	$countother = DB::table('table_idx')->count()+1;
    $count = Data_kode_lokasi::count()+1;
    $bool = Data_kode_lokasi::where('id_lokasi',$count)->exists();
	while($bool){
		$count = $count+1;
	$bool = Data_kode_lokasi::where('id_lokasi',$count)->exists();
	};
    
    $bp = $request->banyak_penduduk;
        if($bp == ""){
            $penduduk = $request->penduduk;
            if($penduduk != ($request->pria+$request->wanita) ){
                $res = array();
                $res['kec'] = $request->kecamatan;
                $res['kel'] = $request->kelurahan;
                session()->flashInput($request->input());
            // return view('addPendudukKriteria',['res' => $res])->with('success', true)->with('message','Jumlah penduduk Jenis Kelamin tidak sama dengan Status Kawin');
            Alert::error('Jumlah penduduk Jenis Kelamin tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);
            return view('addPendudukKriteria',['res' => $res]);}
            if($penduduk != ($request->belum_kawin+$request->kawin+$request->cerai_hidup+$request->cerai_mati) ){
                $res = array();
                $res['kec'] = $request->kecamatan;
                $res['kel'] = $request->kelurahan;
                session()->flashInput($request->input());
            // return view('addPendudukKriteria',['res' => $res])->with('success', true)->with('message','Jumlah penduduk Jenis Kelamin tidak sama dengan Status Kawin');
            Alert::error('Jumlah penduduk Status Kawin tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);
            return view('addPendudukKriteria',['res' => $res]);
            
        }
            
            if($penduduk != ($request->tidak_bekerja+$request->aparat_pejabat_negara+$request->tenaga_pengajar+$request->wiraswasta
            +$request->pertanian+$request->nelayan+$request->bidang_keagamaan+$request->pelajar_dan_mahasiswa
            +$request->tenaga_kesehatan+$request->pensiunan+$request->lainnya) ){
                $res = array();
                $res['kec'] = $request->kecamatan;
                $res['kel'] = $request->kelurahan;
                session()->flashInput($request->input());
                Alert::error('Jumlah penduduk Pekerjaan tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);
            
                return view('addPendudukKriteria',['res' => $res]);
            }

            if($penduduk != ($request->belum_sekolah+$request->belum_tamat_sd+$request->tamat_sd+$request->smp+$request->sma+$request->di_dii+$request->diii+$request->s1+$request->s2+$request->s3) ){
                $res = array();
                $res['kec'] = $request->kecamatan;
                $res['kel'] = $request->kelurahan;
                session()->flashInput($request->input());
            Alert::error('Jumlah penduduk Pendidikan tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('addPendudukKriteria',['res' => $res]);
            }
            if($penduduk != ($request->u0_4+$request->u5_9+$request->u10_14+$request->u15_19+$request->u20_24+$request->u25_29+$request->u30_34+$request->u35_39+$request->u40_44+$request->u45_49
            +$request->u50_54+$request->u55_59+$request->u60_64+$request->u65_69+$request->u70_74+$request->u75_above) ){
                $res = array();
                $res['kec'] = $request->kecamatan;
                $res['kel'] = $request->kelurahan;
                session()->flashInput($request->input());
            Alert::error('Jumlah penduduk Umur tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('addPendudukKriteria',['res' => $res]);
            }

            Data_kode_lokasi::insert([
                'id_lokasi' => $count,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'banyak_penduduk' => $penduduk,
                'idx_table' => $countother
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "data_kode_lokasi",
                'event' => "Insert",
                'kunci' => $count
            ]);

            DB::table('jk')->insert([
                'id_lokasi' => $count,
                'pria' => $request->pria,
                'wanita' => $request->wanita
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "jk",
                'event' => "Insert",
                'kunci' => $count
            ]);

            DB::table('sk')->insert([
                'id_lokasi' => $count,
                'belum_kawin' => $request->belum_kawin,
                'kawin' => $request->kawin,
                'cerai_hidup' => $request->cerai_hidup,
                'cerai_mati' => $request->cerai_mati
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "sk",
                'event' => "Insert",
                'kunci' => $count
            ]);

            DB::table('pendidikan')->insert([
                'id_lokasi' => $count,
                'belum_sekolah' => $request->belum_sekolah,
                'belum_tamat_sd' => $request->belum_tamat_sd,
                'tamat_sd' => $request->tamat_sd,
                'smp' => $request->smp,
                'sma' => $request->sma,
                'di_dii' => $request->di_dii,
                'diii' => $request->diii,
                's1' => $request->s1,
                's2' => $request->s2,
                's3' => $request->s3
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "pendidikan",
                'event' => "Insert",
                'kunci' => $count
            ]);

            DB::table('pekerjaan')->insert([
                'id_lokasi' => $count,
                'tidak_bekerja' => $request->tidak_bekerja,
                'aparat_pejabat_negara' => $request->aparat_pejabat_negara,
                'tenaga_pengajar' => $request->tenaga_pengajar,
                'wiraswasta' => $request->wiraswasta,
                'pertanian' => $request->pertanian,
                'nelayan' => $request->nelayan,
                'bidang_keagamaan' => $request->bidang_keagamaan,
                'pelajar_dan_mahasiswa' => $request->pelajar_dan_mahasiswa,
                'tenaga_kesehatan' => $request->tenaga_kesehatan,
                'pensiunan' => $request->pensiunan,
                'lainnya' => $request->lainnya
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "pekerjaan",
                'event' => "Insert",
                'kunci' => $count
            ]);

            DB::table('umur')->insert([
                'id_lokasi' => $count,
                'u0_4' => $request->u0_4,
                'u5_9' => $request->u5_9,
                'u10_14' => $request->u10_14,
                'u15_19' => $request->u15_19,
                'u20_24' => $request->u20_24,
                'u25_29' => $request->u25_29,
                'u30_34' => $request->u30_34,
                'u35_39' => $request->u35_39,
                'u40_44' => $request->u40_44,
                'u45_49' => $request->u45_49,
                'u50_54' => $request->u50_54,
                'u55_59' => $request->u55_59,
                'u60_64' => $request->u60_64,
                'u65_69' => $request->u65_69,
                'u70_74' => $request->u70_74,
                'u75_above' => $request->u75_above
            ]);


            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "umur",
                'event' => "Insert",
                'kunci' => $count
            ]);

        } else {
            $banyak_penduduk = $bp;
            Data_kode_lokasi::insert([
                'id_lokasi' => $count,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'banyak_penduduk' => $banyak_penduduk,
                'idx_table' => $countother
            ]);
            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "data_kode_lokasi",
                'event' => "Insert",
                'kunci' => $count
            ]);
        }
        

    
	
       

        Alert::success('Silahkan lihat datamu', 'Data Ditambahkan')->autoclose(5000);
    
	// alihkan halaman ke halaman pegawai
	return redirect('/penduduk');
 
}
public function delete(Request $request, $id_lokasi)
        {
            $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
            $admin = $request->session()->get('id');
            
                        $idx = DB::table('data_kode_lokasi')->select('idx_table')->where('id_lokasi',$id_lokasi)->first();
                        // menghapus data pegawai berdasarkan id yang dipilih
                        DB::table('jk')->where('id_lokasi',$id_lokasi)->delete();
                        DB::table('sk')->where('id_lokasi',$id_lokasi)->delete();
                        DB::table('pendidikan')->where('id_lokasi',$id_lokasi)->delete();
                        DB::table('pekerjaan')->where('id_lokasi',$id_lokasi)->delete();
                        DB::table('umur')->where('id_lokasi',$id_lokasi)->delete();
            
                        Data_kode_lokasi::where('id_lokasi',$id_lokasi)->delete();
                            
                        DB::table('log_edit')->insert([
                            'idx_table' => $idx->idx_table,
                            'id_admin' => $admin,
                            'log' => now(),
                            'tabel' => "data_kode_lokasi",
                            'event' => "delete",
                            'kunci' => $id_lokasi
                        ]);
                 
        Alert::success('Data Berhasil Dihapuskan', 'Data Dihapuskan')->autoclose(5000);
            
            // alihkan halaman ke halaman pegawai
            return redirect('/penduduk');
        }
        public function edit(Request $request, $id_lokasi)
        {
            $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
            // mengambil data pegawai berdasarkan id yang dipilih
            $datapenduduk = Data_kode_lokasi::where('id_lokasi',$id_lokasi)->get();
            // passing data pegawai yang didapat ke view edit.blade.php
            return view('editPenduduk',['datapenduduk' => $datapenduduk]);
         
        }

        public function update(Request $request)
{
    $id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
	$admin = $request->session()->get('id');;
	$countother = $request->idx_table;
    $count = Data_kode_lokasi::count()+1;
    
    // $bp = $request->banyak_penduduk;
        // if($bp == ""){
            $penduduk = $request->banyak_penduduk;
            if($penduduk != ($request->pria+$request->wanita) ){
                
                session()->flashInput($request->input());
                $datapenduduk = Data_kode_lokasi::where('id_lokasi',$request->id_lokasi)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah penduduk Jenis Kelamin tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

                return view('editPenduduk',['datapenduduk' => $datapenduduk]);}
            if($penduduk != ($request->belum_kawin+$request->kawin+$request->cerai_hidup+$request->cerai_mati) ){
                
                session()->flashInput($request->input());
                $datapenduduk = Data_kode_lokasi::where('id_lokasi',$request->id_lokasi)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah penduduk Status Kawin tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

                return view('editPenduduk',['datapenduduk' => $datapenduduk]);
        }
            
            if($penduduk != ($request->tidak_bekerja+$request->aparat_pejabat_negara+$request->tenaga_pengajar+$request->wiraswasta
            +$request->pertanian+$request->nelayan+$request->bidang_keagamaan+$request->pelajar_dan_mahasiswa
            +$request->tenaga_kesehatan+$request->pensiunan+$request->lainnya) ){
               session()->flashInput($request->input());
               $datapenduduk = Data_kode_lokasi::where('id_lokasi',$request->id_lokasi)->get();
               // passing data pegawai yang didapat ke view edit.blade.php
               Alert::error('Jumlah penduduk Pekerjaan tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

               return view('editPenduduk',['datapenduduk' => $datapenduduk]);
            }

            if($penduduk != ($request->belum_sekolah+$request->belum_tamat_sd+$request->tamat_sd+$request->smp+$request->sma+$request->di_dii+$request->diii+$request->s1+$request->s2+$request->s3) ){
                session()->flashInput($request->input());
                $datapenduduk = Data_kode_lokasi::where('id_lokasi',$request->id_lokasi)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah penduduk Pendidikan tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

                return view('editPenduduk',['datapenduduk' => $datapenduduk]);}            
            if($penduduk != ($request->u0_4+$request->u5_9+$request->u10_14+$request->u15_19+$request->u20_24+$request->u25_29+$request->u30_34+$request->u35_39+$request->u40_44+$request->u45_49
            +$request->u50_54+$request->u55_59+$request->u60_64+$request->u65_69+$request->u70_74+$request->u75_above) ){
                
                session()->flashInput($request->input());
                $datapenduduk = Data_kode_lokasi::where('id_lokasi',$request->id_lokasi)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah penduduk Umur tidak sama dengan Penduduk Total', 'Input Gagal')->autoclose(5000);

                return view('editPenduduk',['datapenduduk' => $datapenduduk]);
            }

            DB::table('data_kode_lokasi')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'banyak_penduduk' => $penduduk,
                'idx_table' => $countother
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "data_kode_lokasi",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

            DB::table('jk')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'pria' => $request->pria,
                'wanita' => $request->wanita
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "jk",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

            DB::table('sk')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'belum_kawin' => $request->belum_kawin,
                'kawin' => $request->kawin,
                'cerai_hidup' => $request->cerai_hidup,
                'cerai_mati' => $request->cerai_mati
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "sk",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

            DB::table('pendidikan')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'belum_sekolah' => $request->belum_sekolah,
                'belum_tamat_sd' => $request->belum_tamat_sd,
                'tamat_sd' => $request->tamat_sd,
                'smp' => $request->smp,
                'sma' => $request->sma,
                'di_dii' => $request->di_dii,
                'diii' => $request->diii,
                's1' => $request->s1,
                's2' => $request->s2,
                's3' => $request->s3
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "pendidikan",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

            DB::table('pekerjaan')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'tidak_bekerja' => $request->tidak_bekerja,
                'aparat_pejabat_negara' => $request->aparat_pejabat_negara,
                'tenaga_pengajar' => $request->tenaga_pengajar,
                'wiraswasta' => $request->wiraswasta,
                'pertanian' => $request->pertanian,
                'nelayan' => $request->nelayan,
                'bidang_keagamaan' => $request->bidang_keagamaan,
                'pelajar_dan_mahasiswa' => $request->pelajar_dan_mahasiswa,
                'tenaga_kesehatan' => $request->tenaga_kesehatan,
                'pensiunan' => $request->pensiunan,
                'lainnya' => $request->lainnya
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "pekerjaan",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

            DB::table('umur')->where('id_lokasi',$request->id_lokasi)->update([
                // 'id_lokasi' => $count,
                'u0_4' => $request->u0_4,
                'u5_9' => $request->u5_9,
                'u10_14' => $request->u10_14,
                'u15_19' => $request->u15_19,
                'u20_24' => $request->u20_24,
                'u25_29' => $request->u25_29,
                'u30_34' => $request->u30_34,
                'u35_39' => $request->u35_39,
                'u40_44' => $request->u40_44,
                'u45_49' => $request->u45_49,
                'u50_54' => $request->u50_54,
                'u55_59' => $request->u55_59,
                'u60_64' => $request->u60_64,
                'u65_69' => $request->u65_69,
                'u70_74' => $request->u70_74,
                'u75_above' => $request->u75_above
            ]);


            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "umur",
                'event' => "update",
                'kunci' => $request->id_lokasi
            ]);

        // } else {
        //     $banyak_penduduk = $bp;
        //     Data_kode_lokasi::insert([
        //         'id_lokasi' => $count,
        //         'kecamatan' => $request->kecamatan,
        //         'kelurahan' => $request->kelurahan,
        //         'banyak_penduduk' => $banyak_penduduk,
        //         'idx_table' => $countother
        //     ]);
        //     DB::table('log_edit')->insert([
        //         'idx_table' => $countother,
        //         'id_admin' => $admin,
        //         'log' => now(),
        //         'tabel' => "kode_lokasi",
        //         'event' => "Insert",
        //         'kunci' => $count
        //     ]);
        // }
        

    
	
       

        Alert::success('Silahkan lihat datamu', 'Edit Berhasil')->autoclose(3000);
    
	// alihkan halaman ke halaman pegawai
	return redirect('/penduduk');
 
}public function cetak_pdf(Request $request, $jenis)
{
    $penduduk = Data_kode_lokasi::all();
    
    $pdf = PDF::loadview('penduduk_pdf',['penduduk'=>$penduduk],['jenis'=>$jenis]);
    return $pdf->stream();
    // return view('penduduk_pdf',['penduduk'=>$penduduk],['jenis'=>$jenis]);
}
public function export_excel($jenis)
{
    if($jenis == "jk"){
        return Excel::download(new JkExport, 'datapendudukberdasarkanjk.xlsx');
    }if($jenis == "sk"){
        return Excel::download(new SkExport, 'datapendudukberdasarkansk.xlsx');
    }if($jenis == "pendidikan"){
        return Excel::download(new PendidikanExport, 'datapendudukberdasarkanpendidikan.xlsx');
    }if($jenis == "pekerjaan"){
        return Excel::download(new PekerjaanExport, 'datapendudukberdasarkanpekerjaan.xlsx');
    }if($jenis == "umur"){
        return Excel::download(new UmurExport, 'datapendudukberdasarkanumur.xlsx');
    }if($jenis == "data"){
        return Excel::download(new Data_kode_lokasiExport, 'datapenduduk.xlsx');
    }
}
public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
            'filedata_kode_lokasi' => 'required|mimes:csv,xls,xlsx',
            'filejk' => 'required|mimes:csv,xls,xlsx',
            'filesk' => 'required|mimes:csv,xls,xlsx',
            'filependidikan' => 'required|mimes:csv,xls,xlsx',
            'filepekerjaan' => 'required|mimes:csv,xls,xlsx',
            'fileumur' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$filedata_kode_lokasi = $request->file('filedata_kode_lokasi');
		$filejk = $request->file('filejk');
		$filesk = $request->file('filesk');
		$filependidikan = $request->file('filependidikan');
		$filepekerjaan = $request->file('filepekerjaan');
		$fileumur = $request->file('fileumur');
		
		// membuat nama file unik
		$nama_filedata_kode_lokasi = rand().$filedata_kode_lokasi->getClientOriginalName();
		$nama_filejk = rand().$filejk->getClientOriginalName();
		$nama_filesk = rand().$filesk->getClientOriginalName();
		$nama_filependidikan = rand().$filependidikan->getClientOriginalName();
		$nama_filepekerjaan = rand().$filepekerjaan->getClientOriginalName();
		$nama_fileumur = rand().$fileumur->getClientOriginalName();
		
		// upload ke folder file_siswa di dalam folder public
		$filedata_kode_lokasi->move('file_upload',$nama_filedata_kode_lokasi);
		$filejk->move('file_upload',$nama_filejk);
		$filesk->move('file_upload',$nama_filesk);
		$filependidikan->move('file_upload',$nama_filependidikan);
		$filepekerjaan->move('file_upload',$nama_filepekerjaan);
		$fileumur->move('file_upload',$nama_fileumur);
		// import data
		Excel::import(new Data_kode_lokasiImport, public_path('../../admin/file_upload/'.$nama_filedata_kode_lokasi));
		Excel::import(new JkImport, public_path('../../admin/file_upload/'.$nama_filejk));
		Excel::import(new SkImport, public_path('../../admin/file_upload/'.$nama_filesk));
		Excel::import(new PendidikanImport, public_path('../../admin/file_upload/'.$nama_filependidikan));
		Excel::import(new PekerjaanImport, public_path('../../admin/file_upload/'.$nama_filepekerjaan));
		Excel::import(new UmurImport, public_path('../../admin/file_upload/'.$nama_fileumur));
 
		// notifikasi dengan session
		Alert::success('Silahkan lihat datamu', 'Upload data sukses')->autoclose(3000);
		
		// alihkan halaman kembali
		return redirect('/penduduk');
	}
}
