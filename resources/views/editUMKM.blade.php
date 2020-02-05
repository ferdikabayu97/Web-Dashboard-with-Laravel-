<!DOCTYPE html>
<html>
<head>
    <title>Edit UMKM - Rekusaha</title>
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
<h1 class="text-center mt-5 border-bottom border-dark">Edit Data UMKM</h1>

                            <br/>
<div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
 
	@foreach($dataUMKM as $p)
	<form action="/umkm/update" method="post">
        {{ csrf_field() }}
        
		<input type="hidden" name="no" value="{{ $p->no }}"> <br/>
        <div class="col">
                <div class="row m-3">
                        <div class="col m-1">
                            Nama Perusahaan <br/> <input class="form-control" type="text" name="namaper" required="required" value = "{{ $p->nama_perusahaan }}"> <br/>
                        </div>
                        <div class="col m-1">
                            Nama Pemilik <br/><input class="form-control" type="text" name="namapem" required="required" value = "{{ $p->nama_pemilik }}"> <br/>
                        </div>
                </div>
            <div class="row m-3">
                <div class="col">
        
                    <div class="col m-1">
                        Alamat <br/><textarea class="form-control" name="alamat" required="required">{{ $p->alamat }}</textarea> <br/> 
                    </div>
                    <div class="col m-1">
                        Telpon <br/><input class="form-control" type="text" name="telp" required="required" value = "{{ $p->telp }}"> <br/>
                    </div>
                    <div class="col m-1">
                        Jenis Usaha <br/><input class="form-control" type="text" name="ju" required="required" value = "{{ $p->jenis_usaha }}"> <br/>
                    </div>
		        </div>
		    </div>

            <div class="row m-3">
                <div class="col m-1">    
                    Jumlah <br/><input class="form-control" type="number" name="jumb" required="required" value = "{{ $p->jumlah }}"> <br/>
                </div>
                <div class="col m-1">
                    Aset<br/> <input class="form-control" type="number" name="aset" required="required" value = "{{ $p->aset }}"> <br/>
                </div>
                <div class="col m-1">
                    Omset <br/><input class="form-control" type="number" name="omset" required="required" value = "{{ $p->omset }}"> <br/>
                </div>
            </div>
            <div class="row m-3">

        <div class="col m-1">
            Kelurahan <br/><input class="form-control" type="text" name="kel" required="required" value = "{{ $p->kelurahan }}"> <br/>
            </div>
        <div class="col m-1">
            Kecamatan <br/><input class="form-control" type="text" name="kec" required="required" value = "{{ $p->kecamatan }}"> <br/>
            </div>
            </div>
            <div class="row m-3">

        <div class="col m-1">
            Tahun <br/><input class="form-control" type="text" name="tahun" required="required" value = "{{ $p->tahun }}"> <br/>
            </div>
        <div class="col m-1">
            Status Usaha <br/><input class="form-control" type="text" name="ket" required="required" value = "{{ $p->ket }}"> <br/>
            </div>
            </div>
        </div>
        <div class="text-center">
		<input class="btn btn-primary" type="submit" value="Simpan Data">
        </div>
	</form>
	@endforeach
		
</body>
</html>