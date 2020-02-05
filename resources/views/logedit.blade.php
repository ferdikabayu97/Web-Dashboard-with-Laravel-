<!DOCTYPE html>
<html>
<head>
<title>Laman Log Edit - Rekusaha</title>
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
      <li class="nav-item">
        <a class="nav-link" href="/umkm">UMKM </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/penduduk">Penduduk </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/sampelpenduduk">Sampel Penduduk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Log Edit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/user">Pengguna Aplikasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/rekomend">Perekomendasian Usaha</a>
      </li>
    </ul>
    <span class="navbar-text ">
      <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ Session::get('id')}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-right" href="/logout">Logout</a>
          <a class="dropdown-item text-right" href="/gantipass">Ganti Password</a>
        </div>
    </span>
  </div>
</nav>
@include('sweet::alert')
   
    <br/>
    <br/>
    <div class="row justify-content-md-right">
        <div class="col-md-auto ml-auto mr-5 mt-5">
        <div class="row">
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Halaman </div>
                <div class="card-body">
                 <h5 class="card-title text-center">{{ $logedit->currentPage() }}<br/> Dari {{ $logedit->lastPage() }}</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Data</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$logedit->total()}}</h5>
                </div>
            </div>
		</div>
		
        </div>
        </div>

    </div>
	<div class="m-5">

            <div class="card mt-5">
                <div class="card-header text-center">
                    Data Log Edit
                </div>
                <div class="card-body">
				
	<form action="/logedit/search" id="carikan" method="GET" class="text-right">
    <div class="col-md-4">

		
    </div>
		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   value="{{old('cari')}}">{{( old('cari') == "" ? "Pilih Pencarian" : old('cari') )}}</button>
            <div class="dropdown-menu">
            <div role="separator" class="dropdown-divider" ></div>
            <a class="dropdown-item" href="/logedit/search?cari=idx_table" >Index Tabel
            </a>
            <a class="dropdown-item"  href="/logedit/search?cari=id_admin">Id Admin
        </a>
            <a class="dropdown-item" href="/logedit/search?cari=tabel">Tabel
			 </a>
			 <a class="dropdown-item" href="/logedit/search?cari=event">Event
			 </a>
			 <a class="dropdown-item" href="/logedit/search?cari=kunci">Kunci Tabel
             </a>
             <input name="cari" type="hidden" value= "{{old('cari') }}">
            </div>
        </div>
        <input type="text" class="form-control" aria-label="Text input with dropdown button"  name="search" placeholder="Cari {{old('cari')}} .." value="{{ old('search') }}" onchange='this.form.submit()'>
        <!-- <input type="text" class="form-control" aria-label="Text input with dropdown button"> -->
        </div>

		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
	</form>
		
    <font size="1">
    <div class="text-right">
    <a href="/logedit/export_excel/" class="btn btn-success my-3" target="_blank"><img src="/images/excel.png" width="20" height="20" class="d-inline-block align-top" alt=""> EXPORT EXCEL</a>
    
    <a href="/logedit/cetak_pdf/#" class="btn btn-danger" target="_blank"><img src="/images/pdf.png" width="20" height="20" class="d-inline-block align-top" alt=""> CETAK PDF </a>
    
    </div>
<br/>
	<table class="table table-bordered table-hover table-striped text-center">
		<tr>
			<th>Index Tabel</th>
			<th>Id Admin</th>
			<th>Log</th>
			<th>Tabel</th>
			<th>Event</th>
            <th>Kunci Tabel</th>
            

		</tr>
		@foreach($logedit as $p)
		<tr>
			<td>{{ $p->idx_table }}</td>
			<td>{{ $p->id_admin }}</td>
			<td>{{ $p->log }}</td>
			<td>{{ $p->tabel }}</td>
            <td>{{ $p->event }}</td>
			<td>{{ $p->kunci }}</td>
			
			
		</tr>
		@endforeach
	</table>
	</font>
 
 
	{{ $logedit->links() }}
	</div>
		</div>
	</div>
</body>
</html>