<!DOCTYPE html>
<html>
<head>
    <title>Add Penduduk - Rekusaha</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
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
@include('sweet::alert')
<br/>
<br/>
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/penduduk/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Penduduk</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file data lokasi anda</label>
							<div class="form-group">
								<input type="file" name="filedata_kode_lokasi" required="required">
							</div>
              <label>Pilih file penduduk sesuai jenis kelamin</label>
							<div class="form-group">
								<input type="file" name="filejk" required="required">
							</div>
              <label>Pilih file penduduk sesuai status kawin</label>
							<div class="form-group">
								<input type="file" name="filesk" required="required">
							</div>
              <label>Pilih file penduduk sesuai pendidikan</label>
							<div class="form-group">
								<input type="file" name="filependidikan" required="required">
							</div>
              <label>Pilih file penduduk sesuai pekerjaan</label>
							<div class="form-group">
								<input type="file" name="filepekerjaan" required="required">
							</div>
              <label>Pilih file penduduk sesuai umur</label>
							<div class="form-group">
								<input type="file" name="fileumur" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
        <!--  -->
<h1 class="text-center mt-5 border-bottom border-dark">Tambah Data Penduduk</h1>
<div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
 
	
    <?php
 
    if ($res['kec'] == ""){  ?>
 
 <form action="/penduduk/add/kriteria" method="post">
		{{ csrf_field() }}
    {{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
 
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcel">
        <img src="/images/excel.png" width="20" height="20" class="d-inline-block align-top" alt=""> + Tambahkan data dari file excel
		</button>
	
	<br/>
	<br/>
        <div class="form-group">
			Kecamatan <br/> <input class="form-control" type="text" name="kecamatan" required="required"> <br/>
		</div>
        <div class="form-group">
        	Kelurahan (Opsional) <br/><input class="form-control" type="text" name="kelurahan"> <br/>
        </div>
        <div class="text-center">
        
		<input class="btn btn-primary" type="submit" value="Selanjutnya">
        </div>

	    </form>
        <?php }else{ ?>
    	<form action="/penduduk/store" method="post">
        {{ csrf_field() }}
        <br/>
	<br/>
        <input name="kecamatan" type="hidden" value= "{{ $res['kec'] }}">
        <input name="kelurahan" type="hidden" value= "{{ $res['kel'] }}">
        <div class="form-group">
        	Banyak Penduduk <br/><input class="form-control" type="text" name="banyak_penduduk"> <br/>
        </div>
        <div class="text-center">
		<input class="btn btn-primary" type="submit" value="Simpan">
        </div>
        </form>
        <?php } ?>
    </div>
                    </div>
                </div>
            </div>
        </div>
 
</body>
</html>