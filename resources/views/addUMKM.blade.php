<!DOCTYPE html>
<html>
<head>
    <title>Add UMKM - Rekusaha</title>
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
      <a href="/umkm">
          Kembali
        </a>
    </span>
  </div>
</nav>
<br/>
<br/>
<h1 class="text-center mt-5 border-bottom border-dark">Tambah Data UMKM</h1>

                            <br/>
<div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
 <!-- Import Excel -->
 <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/umkm/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Data UMKM</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file umkm anda</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
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
	<form action="/umkm/store" method="post">
        {{ csrf_field() }}
        <!--  -->
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
        <div class="col">
                <div class="row m-3">
                        <div class="col m-1">
                            Nama Perusahaan <br/> <input class="form-control" type="text" name="namaper" required="required" value = "{{ old('namaper') }}"> <br/>
                        </div>
                        <div class="col m-1">
                            Nama Pemilik <br/><input class="form-control" type="text" name="namapem" required="required" value = "{{ old('namapem') }}"> <br/>
                        </div>
                </div>
            <div class="row m-3">
                <div class="col">
        
                    <div class="col m-1">
                        Alamat <br/><textarea class="form-control" name="alamat" required="required">{{ old('alamat') }}</textarea> <br/> 
                    </div>
                    <div class="col m-1">
                        Telpon <br/><input class="form-control" type="text" name="telp" required="required" value = "{{ old('telp') }}"> <br/>
                    </div>
                    <div class="col m-1">
                        Jenis Usaha <br/><input class="form-control" type="text" name="ju" required="required" value = "{{ old('ju') }}"> <br/>
                    </div>
		        </div>
		    </div>

            <div class="row m-3">
                <div class="col m-1">    
                    Jumlah <br/><input class="form-control" type="number" name="jumb" required="required" value = "{{ old('jumb') }}"> <br/>
                </div>
                <div class="col m-1">
                    Aset<br/> <input class="form-control" type="number" name="aset" required="required" value = "{{ old('aset') }}"> <br/>
                </div>
                <div class="col m-1">
                    Omset <br/><input class="form-control" type="number" name="omset" required="required" value = "{{ old('omset') }}"> <br/>
                </div>
            </div>
            <div class="row m-3">

        <div class="col m-1">
            Kelurahan <br/><input class="form-control" type="text" name="kel" required="required" value = "{{ old('kel') }}"> <br/>
            </div>
        <div class="col m-1">
            Kecamatan <br/><input class="form-control" type="text" name="kec" required="required" value = "{{ old('kec') }}"> <br/>
            </div>
            </div>
            <div class="row m-3">

        <div class="col m-1">
            Tahun <br/><input class="form-control" type="text" name="tahun" required="required" value = "{{ old('tahun') }}"> <br/>
            </div>
        <div class="col m-1">
            Status Usaha <br/><input class="form-control" type="text" name="ket" required="required" value = "{{ old('ket') }}"> <br/>
            </div>
            </div>
        </div>
        <div class="text-center">
		<input class="btn btn-primary" type="submit" value="Simpan Data">
        </div>
	</form>
		
</body>
</html>