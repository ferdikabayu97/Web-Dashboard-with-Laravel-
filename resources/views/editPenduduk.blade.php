<!DOCTYPE html>
<html>
<head>
    <title>Edit Penduduk - Rekusaha</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</head>
<body>
@include('sweet::alert')
<nav class="navbar navbar-expand-lg fixed-top navbar-light border-bottom border-dark" style="background-color: #ecf0f1;">
  <a class="navbar-brand" href="#">
    <img src="/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    <img src="/images/text.png" height="30" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarText">
    <ul class="navbar-nav mr-auto ">
 
    </ul>
    <span class="navbar-text ">
      <a href="/penduduk">
          Kembali
        </a>
    </span>
  </div>
</nav>
<br/>
<br/>
<h1 class="text-center mt-5 border-bottom border-dark">Edit Data Penduduk</h1>

                            <br/>
<div class="container">
            <div class="row justify-content-center">
                
                    <div class="card mt-3">
                        <div class="card-body">
                            
 
	
	
    <div class="form-group">
    @foreach($datapenduduk as $p)
	<form action="/penduduk/update" method="post">
		{{ csrf_field() }}
        <input  name="id_lokasi" type="hidden" value= "{{ $p->id_lokasi }}">
        <input  name="idx_table" type="hidden" value= "{{ $p->idx_table }}">

        <div class="form-group">
			Kecamatan <br/> <input class="form-control" type="text" name="kecamatan" required="required" value = "{{ $p->kecamatan }}"> <br/>
		</div>
        <div class="form-group">
        	Kelurahan (Opsional) <br/><input class="form-control" type="text" name="kelurahan" value = "{{ $p->kelurahan }}"> <br/>
		</div>
        <div class="form-group">
        	Banyak Penduduk <br/><input class="form-control" type="text" name="banyak_penduduk" value="{{ $p->banyak_penduduk }}"> <br/>
		</div>
        <table class="col-sm-12">
        <tr><td>
        <font size="3">Jenis Kelamin</font>
        <font size="2">
        <table class="table table-hover table-borderless table-active">
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">Pria</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="pria" required="required" value="{{ $p->jk->pria }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Wanita</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="wanita" required="required" value="{{ $p->jk->wanita }}">
        </td>
        
        </tr>
        </table>
        </td>
        <td>
        </font>
        <font size="3" class =" col-sm-4">Status Kawin</font>
        <font size="2">
        <table class="table table-hover table-borderless table-active" >
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">Belum Kawin</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="belum_kawin" required="required" value="{{ $p->sk->belum_kawin }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Kawin</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="kawin" required="required" value="{{ $p->sk->kawin }}">
        </td>
        
        <td>
        <div class="form-group">
        <label for="inputsm">Cerai Hidup </label>
        <input class="form-control input-sm" id="inputsm" type="text" name="cerai_hidup" required="required" value="{{ $p->sk->cerai_hidup }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Cerai Mati</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="cerai_mati" required="required" value="{{ $p->sk->cerai_mati }}">
        </td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </font>
        <font size="3">Pekerjaan</font>
        <font size="2">
        <table class="table table-hover col-sm-12 table-borderless table-active">
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">Tidak Bekerja</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="tidak_bekerja" required="required" value="{{ $p->pekerjaan->tidak_bekerja }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Aparat Pejabat Negara</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="aparat_pejabat_negara" required="required" value="{{ $p->pekerjaan->aparat_pejabat_negara }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">Tenaga Pengajar</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="tenaga_pengajar" required="required" value="{{ $p->pekerjaan->tenaga_pengajar }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Wiraswasta</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="wiraswasta" required="required" value="{{ $p->pekerjaan->wiraswasta }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">Pertanian</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="pertanian" required="required" value="{{ $p->pekerjaan->pertanian }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Nelayan</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="nelayan" required="required" value="{{ $p->pekerjaan->nelayan }}">
        </td>
        </tr>
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">Bidang Keagamaan</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="bidang_keagamaan" required="required" value="{{ $p->pekerjaan->bidang_keagamaan }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Pelajar dan Mahasiswa</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="pelajar_dan_mahasiswa" required="required" value="{{ $p->pekerjaan->pelajar_dan_mahasiswa }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">Tenaga Kesehatan</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="tenaga_kesehatan" required="required" value="{{ $p->pekerjaan->tenaga_kesehatan }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Pensiunan</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="pensiunan" required="required" value="{{ $p->pekerjaan->pensiunan }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">Lainnya</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="lainnya" required="required" value="{{ $p->pekerjaan->lainnya }}">
        </div>
        </td>
        </tr>
        </table>
        <font size="3">Pendidikan</font>
        <font size="2">
        <table class="table table-hover col-sm-12 table-borderless table-active">
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">Belum sekolah</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="belum_sekolah" required="required" value="{{ $p->pendidikan->belum_sekolah }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">Belum Tamat SD</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="belum_tamat_sd" required="required" value="{{ $p->pendidikan->belum_tamat_sd }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">SD</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="tamat_sd" required="required" value="{{ $p->pendidikan->tamat_sd }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">SMP</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="smp" required="required" value="{{ $p->pendidikan->smp }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">SMA</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="sma" required="required" value="{{ $p->pendidikan->sma }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">DI dan DII</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="di_dii" required="required" value="{{ $p->pendidikan->di_dii }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">DIII</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="diii" required="required" value="{{ $p->pendidikan->diii }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">S1</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="s1" required="required" value="{{ $p->pendidikan->s1 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">S2</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="s2" required="required" value="{{ $p->pendidikan->s2 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">S3</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="s3" required="required" value="{{ $p->pendidikan->s3 }}">
        </div>
        </td>
        </tr>
        </table>
        </font>
        </font>
        <font size="3">Umur</font>
        <font size="2">
        <table class="table table-hover col-sm-12 table-borderless table-active">
        <tr>
        <td>
        <div class="form-group">
        <label for="inputsm">0-4</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u0_4" required="required" value="{{ $p->umur->u0_4 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">5-9</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u5_9" required="required" value="{{ $p->umur->u5_9 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">10-14</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u10_14" required="required" value="{{ $p->umur->u10_14 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">15-19</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u15_19" required="required" value="{{ $p->umur->u15_19 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">20-24</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u20_24" required="required" value="{{ $p->umur->u20_24 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">25-29</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u25_29" required="required" value="{{ $p->umur->u25_29 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">30-34</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u30_34" required="required" value="{{ $p->umur->u30_34 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">35-39</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u35_39" required="required" value="{{ $p->umur->u35_39 }}">
        </div></td>
        </tr><tr>
        <td>
        
        <div class="form-group">
        <label for="inputsm">40-44</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u40_44" required="required" value="{{ $p->umur->u40_44 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">45_49</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u45_49" required="required" value="{{ $p->umur->u45_49 }}">
        </div>
        </td>
        
        <td>
        <div class="form-group">
        <label for="inputsm">50-54</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u50_54" required="required" value="{{ $p->umur->u50_54 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">55-59</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u55_59" required="required" value="{{ $p->umur->u55_59 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">60-64</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u60_64" required="required" value="{{ $p->umur->u60_64 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">65-69</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u65_69" required="required" value="{{ $p->umur->u65_69 }}">
        </div></td>
        <td>
        <div class="form-group">
        <label for="inputsm">70-74</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u70_74" required="required" value="{{ $p->umur->u70_74 }}">
        </td>
        <td>
        <div class="form-group">
        <label for="inputsm">75 Keatas</label>
        <input class="form-control input-sm" id="inputsm" type="text" name="u75_above" required="required" value="{{ $p->umur->u75_above }}">
        </div>
        </td>
        </tr>
        </table>
        </font>
        </font>
        <div class="text-center">
        <input class="btn btn-primary" type="submit" value="Simpan">
        </div>
	</form>
	@endforeach

    </div>
                    </div>
                </div>
            
        </div>

</body>
</html>