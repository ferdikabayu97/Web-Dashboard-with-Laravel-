<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Alert;
use App\Alternatif;
use App\Exports\AlternatifExport;
use App\Exports\Jk_alExport;
use App\Exports\Sk_alExport;
use App\Exports\Pekerjaan_alExport;
use App\Exports\Pendidikan_alExport;
use App\Exports\Umur_alExport;
use App\Exports\Rek_hargaExport;
use App\Imports\AlternatifImport;
use App\Imports\Jk_alImport;
use App\Imports\Sk_alImport;
use App\Imports\Pekerjaan_alImport;
use App\Imports\Pendidikan_alImport;
use App\Imports\Umur_alImport;
use App\Imports\Rek_hargaImport;

use Maatwebsite\Excel\Facades\Excel;

class SampelPendudukController extends Controller
{
    public function index(Request $request)
    {$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
            session()->flashInput($request->input());

    	// mengambil semua data pengguna
        // return data ke view
        // dd($penduduk->jk->pria);
        $jenisb = $request->kriteria;
        $chart = Alternatif::orderByRaw('id_alternatif asc')->get();
        $lenght = DB::table('jk_al')->count('pria');
        if (substr($request->chart,1)+0 > $lenght){
            Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
			return redirect()->back();	

        }
        if($jenisb == ""){
            $jenis = "jk_al";
            
        } else {$jenis = $jenisb;}
    	$sampelpenduduk = Alternatif::orderByRaw('id_alternatif asc')->paginate(10)->appends('kriteria',$jenis);


    	return view('sampelpenduduk', ['jenis' => $jenis], ['chart' => $chart,'sampelpenduduk' => $sampelpenduduk]);
    }

    public function kategori(Request $request)
    {$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
            session()->flashInput($request->input());

            $jenisb = $request->kriteria;
            $chart = Alternatif::orderByRaw('id_alternatif asc')->get();
            $lenght = DB::table('jk_al')->count('pria');
            if (substr($request->chart,1)+0 > $lenght){
                Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
                return redirect()->back();	
    
            }
            if($jenisb == ""){
                $jenis = "jk_al";
                
            } else {$jenis = $jenisb;}
    	$sampelpenduduk = Alternatif::orderByRaw('id_alternatif asc')->paginate(10)->appends('kriteria',$jenis);
        
    	return view('sampelpenduduk', ['jenis' => $jenis], ['chart' => $chart,'sampelpenduduk' => $sampelpenduduk]);
    }

    public function search(Request $request)
	{$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
		// menangkap data pencarian
		$search = $request->search;
        $jenisb = $request->kriteria;
            $chart = Alternatif::orderByRaw('id_alternatif asc')->get();
            $lenght = DB::table('jk_al')->count('pria');
            if (substr($request->chart,1)+0 > $lenght){
                Alert::error('ID Kepanjangan', 'Cari chart salah')->autoclose(5000);
                return redirect()->back();	
    
            }
            if($jenisb == ""){
                $jenis = "jk_al";
                
            } else {$jenis = $jenisb;}
            // mengambil data dari table pegawai sesuai pencarian data
        session()->flashInput($request->input());
            
            $cari = $request->cari;
        if($cari == ""){
            $cari = "nama_alternatif";        
        }
		$sampelpenduduk = Alternatif::where($cari,'like',"%".$search."%")->orderByRaw('id_alternatif asc')->paginate(10)->appends(['cari' => $cari,'jenis' => $jenis]);
 
    	return view('sampelpenduduk', ['jenis' => $jenis], ['chart' => $chart,'sampelpenduduk' => $sampelpenduduk],['search' => $search]);
        // mengirim data pegawai ke view index
 
	}
    public function add(Request $request)
    {$id = $request->session()->get('id');
		if($id ==""){
			return redirect('/');	
			}
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
        return view('addSampelPenduduk');
     
    }
    public function store(Request $request)
{$id = $request->session()->get('id');
    if($id ==""){
        return redirect('/');	
        }
	$admin = $request->session()->get('id');
	$count = Alternatif::count()+1;
	$countother = DB::table('table_idx')->count()+2;
    
    $id_alternatif = "A".str_pad($count, 2, "0", STR_PAD_LEFT);
    $id_rharga = "H".str_pad($count, 2, "0", STR_PAD_LEFT);
    // insert data ke table pegawai
    DB::table('rek_harga')->insert([
        'id_rharga' => $id_rharga,
        'h5_10' => 0,
                'h10_15' => 0,
                'h15_20' => 0,
                'h20_25' => 0,
                'h25_30' => 0,
                'h30_abv' => 0,
    ]);

    
    Alternatif::insert([
    'id_alternatif' => $id_alternatif,
    'nama_alternatif' => $request->nama_alternatif,
    'banyak_sample' => 0,
    'idx_table' => $countother,
    'id_rharga' => $id_rharga
		]);

	DB::table('log_edit')->insert([
		'idx_table' => $countother,
		'id_admin' => $admin,
		'log' => now(),
		'tabel' => "Alternatif",
		'event' => "Insert",
		'kunci' => $id_alternatif
    ]);

    DB::table('jk_al')->insert([
        'id_alternatif' => $id_alternatif,
        'pria' => 0,
        'wanita' => 0
    ]);

    DB::table('sk_al')->insert([
        'id_alternatif' => $id_alternatif,
        'belum_kawin' => 0,
        'kawin' => 0,
        'cerai_hidup' => 0,
        'cerai_mati' => 0
    ]);


    DB::table('pendidikan_al')->insert([
        'id_alternatif' => $id_alternatif,
        'belum_sekolah' => 0,
        'belum_tamat_sd' => 0,
        'tamat_sd' => 0,
        'smp' => 0,
        'sma' => 0,
        'di_dii' => 0,
        'diii' => 0,
        's1' => 0,
        's2' => 0,
        's3' => 0
    ]);

    DB::table('pekerjaan_al')->insert([
        'id_alternatif' => $id_alternatif,
        'tidak_bekerja' => 0,
        'aparat_pejabat_negara' => 0,
        'tenaga_pengajar' => 0,
        'wiraswasta' => 0,
        'pertanian' => 0,
        'nelayan' => 0,
        'bidang_keagamaan' => 0,
        'pelajar_dan_mahasiswa' => 0,
        'tenaga_kesehatan' => 0,
        'pensiunan' => 0,
        'lainnya' => 0
    ]);

    DB::table('umur_al')->insert([
        'id_alternatif' => $id_alternatif,
        'u0_4' => 0,
        'u5_9' => 0,
        'u10_14' => 0,
        'u15_19' => 0,
        'u20_24' => 0,
        'u25_29' => 0,
        'u30_34' => 0,
        'u35_39' => 0,
        'u40_44' => 0,
        'u45_49' => 0,
        'u50_54' => 0,
        'u55_59' => 0,
        'u60_64' => 0,
        'u65_69' => 0,
        'u70_74' => 0,
        'u75_above' => 0
    ]);

    

	// alihkan halaman ke halaman pegawai
	return redirect('/sampelpenduduk');
 
}
        public function edit(Request $request, $id_alternatif)
        {$id = $request->session()->get('id');
            if($id ==""){
                return redirect('/');	
                }
            // mengambil data pegawai berdasarkan id yang dipilih
            $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
            // passing data pegawai yang didapat ke view edit.blade.php
            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);
         
        }

        public function update(Request $request)
{$id = $request->session()->get('id');
    if($id ==""){
        return redirect('/');	
        }
	$admin = $request->session()->get('id');
	$countother = $request->idx_table;
    
    // $bp = $request->banyak_penduduk;
        // if($bp == ""){
            $id_alternatif = $request->id_alternatif;
            $sampelpenduduk = $request->banyak_sample;
            if($sampelpenduduk != ($request->pria+$request->wanita) ){
                
                session()->flashInput($request->input());
                $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah sampel penduduk Jenis Kelamin tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);}
            if($sampelpenduduk != ($request->belum_kawin+$request->kawin+$request->cerai_hidup+$request->cerai_mati) ){
                
                session()->flashInput($request->input());
                $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah sampel penduduk Status Kawin tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);}
            
            if($sampelpenduduk != ($request->tidak_bekerja+$request->aparat_pejabat_negara+$request->tenaga_pengajar+$request->wiraswasta
            +$request->pertanian+$request->nelayan+$request->bidang_keagamaan+$request->pelajar_dan_mahasiswa
            +$request->tenaga_kesehatan+$request->pensiunan+$request->lainnya) ){
               session()->flashInput($request->input());
               $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
               // passing data pegawai yang didapat ke view edit.blade.php
               Alert::error('Jumlah sampel penduduk Pekerjaan tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);
            }

            if($sampelpenduduk != ($request->belum_sekolah+$request->belum_tamat_sd+$request->tamat_sd+$request->smp+$request->sma+$request->di_dii+$request->diii+$request->s1+$request->s2+$request->s3) ){
                session()->flashInput($request->input());
                $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah sampel penduduk Pendidikan tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);
            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);}          
            if($sampelpenduduk != ($request->u0_4+$request->u5_9+$request->u10_14+$request->u15_19+$request->u20_24+$request->u25_29+$request->u30_34+$request->u35_39+$request->u40_44+$request->u45_49
            +$request->u50_54+$request->u55_59+$request->u60_64+$request->u65_69+$request->u70_74+$request->u75_above) ){
                
                session()->flashInput($request->input());
                $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah sampel penduduk Umur tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);}          

            if($sampelpenduduk != ($request->h5_10+$request->h10_15+$request->h15_20+$request->h20_25+$request->h25_30+$request->h30_abv) ){
                
                session()->flashInput($request->input());
                $datasampelpenduduk = Alternatif::where('id_alternatif',$id_alternatif)->get();
                // passing data pegawai yang didapat ke view edit.blade.php
            Alert::error('Jumlah sampel penduduk rekomendasi harga tidak sama dengan sampel Penduduk Total', 'Input Gagal')->autoclose(5000);

            return view('editSampelPenduduk',['datasampelpenduduk' => $datasampelpenduduk]);} 
            

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "alternatif",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('jk_al')->where('id_alternatif',$request->id_alternatif)->update([
                'pria' => $request->pria,
                'wanita' => $request->wanita
            ]);

            DB::table('alternatif')->where('id_alternatif',$request->id_alternatif)->update([
                // 'id_lokasi' => $count,
                'nama_alternatif' => $request->nama_alternatif,
                'banyak_sample' => $sampelpenduduk,
                'idx_table' => $countother
            ]);

            DB::table('log_edit')->insert([
                'idx_table' => $countother,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "jk_al",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('sk_al')->where('id_alternatif',$request->id_alternatif)->update([
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
                'tabel' => "sk_al",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('pendidikan_al')->where('id_alternatif',$request->id_alternatif)->update([
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
                'tabel' => "pendidikan_al",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('pekerjaan_al')->where('id_alternatif',$request->id_alternatif)->update([
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
                'tabel' => "pekerjaan_al",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('umur_al')->where('id_alternatif',$request->id_alternatif)->update([
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
                'tabel' => "umur_al",
                'event' => "update",
                'kunci' => $request->id_alternatif
            ]);

            DB::table('rek_harga')->where('id_rharga',$request->id_rharga)->update([
                // 'id_alternatif' => $id_alternatif,
                'h5_10' => $request->h5_10,
                'h10_15' => $request->h10_15,
                'h15_20' => $request->h15_20,
                'h20_25' => $request->h20_25,
                'h25_30' => $request->h25_30,
                'h30_abv' => $request->h30_abv
                ]);
                DB::table('log_edit')->insert([
                    'idx_table' => $countother,
                    'id_admin' => $admin,
                    'log' => now(),
                    'tabel' => "rek_harga",
                    'event' => "update",
                    'kunci' => $request->id_rharga
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
        
        Alert::success('Silahkan lihat datamu', 'Edit Berhasil')->autoclose(5000);
    
	// alihkan halaman ke halaman pegawai
	return redirect('/sampelpenduduk');
 
}
public function delete(Request $request, $id_alternatif)
        {$id = $request->session()->get('id');
            if($id ==""){
                return redirect('/');	
                }
            $admin = $request->session()->get('id');
            $idx = DB::table('alternatif')->where('id_alternatif',$id_alternatif)->first();
            // menghapus data pegawai berdasarkan id yang dipilih
            DB::table('jk_al')->where('id_alternatif',$id_alternatif)->delete();
            DB::table('sk_al')->where('id_alternatif',$id_alternatif)->delete();
            DB::table('pendidikan_al')->where('id_alternatif',$id_alternatif)->delete();
            DB::table('pekerjaan_al')->where('id_alternatif',$id_alternatif)->delete();
            DB::table('umur_al')->where('id_alternatif',$id_alternatif)->delete();

            Alternatif::where('id_alternatif',$id_alternatif)->delete();
            DB::table('rek_harga')->where('id_rharga',$idx->id_rharga)->delete();
                
            DB::table('log_edit')->insert([
                'idx_table' => $idx->idx_table,
                'id_admin' => $admin,
                'log' => now(),
                'tabel' => "alternatif",
                'event' => "delete",
                'kunci' => $id_alternatif
            ]);

        Alert::success('Data '.$idx->nama_alternatif.' berhasil dihapuskan', 'Delet Berhasil')->autoclose(5000);

            // alihkan halaman ke halaman pegawai
            return redirect('/sampelpenduduk');
        }
        public function cetak_pdf(Request $request, $jenis)
{
    $sampelpenduduk = Alternatif::all();
    
    $pdf = PDF::loadview('sampelpenduduk_pdf',['sampelpenduduk'=>$sampelpenduduk],['jenis'=>$jenis]);
    return $pdf->stream();
    // return view('penduduk_pdf',['penduduk'=>$penduduk],['jenis'=>$jenis]);
}

public function export_excel($jenis)
{
    if($jenis == "jk_al"){
        return Excel::download(new Jk_alExport, 'datasampelberdasarkanjk.xlsx');
    }if($jenis == "sk_al"){
        return Excel::download(new Sk_alExport, 'datasampelberdasarkansk.xlsx');
    }if($jenis == "pendidikan_al"){
        return Excel::download(new Pendidikan_alExport, 'datasampelberdasarkanpendidikan.xlsx');
    }if($jenis == "pekerjaan_al"){
        return Excel::download(new Pekerjaan_alExport, 'datasampelberdasarkanpekerjaan.xlsx');
    }if($jenis == "umur_al"){
        return Excel::download(new Umur_alExport, 'datasampelberdasarkanumur.xlsx');
    }if($jenis == "rek_harga"){
        return Excel::download(new Rek_hargaExport, 'datasampelberdasarkanrekomendasiharga.xlsx');
    }
    if($jenis == "data"){
        return Excel::download(new AlternatifExport, 'datasampelalternatif.xlsx');
    }
}

public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
            'filealternatif' => 'required|mimes:csv,xls,xlsx',
            'filejk_al' => 'required|mimes:csv,xls,xlsx',
            'filesk_al' => 'required|mimes:csv,xls,xlsx',
            'filependidikan_al' => 'required|mimes:csv,xls,xlsx',
            'filepekerjaan_al' => 'required|mimes:csv,xls,xlsx',
            'fileumur_al' => 'required|mimes:csv,xls,xlsx',
            'filerek_harga' => 'required|mimes:csv,xls,xlsx'
            
		]);
 
		// menangkap file excel
		$filealternatif = $request->file('filealternatif');
		$filejk_al = $request->file('filejk_al');
		$filesk_al = $request->file('filesk_al');
		$filependidikan_al = $request->file('filependidikan_al');
		$filepekerjaan_al = $request->file('filepekerjaan_al');
		$fileumur_al = $request->file('fileumur_al');
		$filerek_harga = $request->file('filerek_harga');
 
		// membuat nama file unik
		$nama_filealternatif = rand().$filealternatif->getClientOriginalName();
		$nama_filejk_al = rand().$filejk_al->getClientOriginalName();
		$nama_filesk_al = rand().$filesk_al->getClientOriginalName();
		$nama_filependidikan_al = rand().$filependidikan_al->getClientOriginalName();
		$nama_filepekerjaan_al = rand().$filepekerjaan_al->getClientOriginalName();
		$nama_fileumur_al = rand().$fileumur_al->getClientOriginalName();
		$nama_filerek_harga = rand().$filerek_harga->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$filealternatif->move('file_upload',$nama_filealternatif);
		$filejk_al->move('file_upload',$nama_filejk_al);
		$filesk_al->move('file_upload',$nama_filesk_al);
		$filependidikan_al->move('file_upload',$nama_filependidikan_al);
		$filepekerjaan_al->move('file_upload',$nama_filepekerjaan_al);
		$fileumur_al->move('file_upload',$nama_fileumur_al);
		$filerek_harga->move('file_upload',$nama_filerek_harga);
 
		// import data
		Excel::import(new Rek_hargaImport, public_path('../../admin/file_upload/'.$nama_filerek_harga));
		Excel::import(new AlternatifImport, public_path('../../admin/file_upload/'.$nama_filealternatif));
		Excel::import(new Jk_alImport, public_path('../../admin/file_upload/'.$nama_filejk_al));
		Excel::import(new Sk_alImport, public_path('../../admin/file_upload/'.$nama_filesk_al));
		Excel::import(new Pendidikan_alImport, public_path('../../admin/file_upload/'.$nama_filependidikan_al));
		Excel::import(new Pekerjaan_alImport, public_path('../../admin/file_upload/'.$nama_filepekerjaan_al));
		Excel::import(new Umur_alImport, public_path('../../admin/file_upload/'.$nama_fileumur_al));
 
		// notifikasi dengan session
		Alert::success('Silahkan lihat datamu', 'Upload data sukses')->autoclose(3000);
		
		// alihkan halaman kembali
		return redirect('/sampelpenduduk');
	}

}
