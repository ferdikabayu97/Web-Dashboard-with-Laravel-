<!DOCTYPE html>
<html>
<head>
<title>Laman Pengguna Aplikasi - Rekusaha</title>
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
        <a class="nav-link" href="/logedit">Log Edit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Pengguna Aplikasi</a>
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

<script>
    

        function confirmDelete(item) {
            swal({
                 title: 'Apakah Anda Yakin?',
                  text: "Anda Tidak Akan Dapat Mengembalikannya!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="/user/delete/"+item;
                       
                    } else {
                        swal("Perintah dibatalkan");
                    }
                });
        }
    </script>
   
    <br/>
    <br/>
    <div class="row justify-content-md-right">
        <div class="col-md-auto ml-auto mr-5 mt-5">
        <div class="row">
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Halaman </div>
                <div class="card-body">
				<?php if(old('kategori') !== ""){ ?>
                 <h5 class="card-title text-center">{{ $User->currentPage() }}<br/> Dari <br/> {{ $User->lastPage() }}</h5>
				<?php }else{ ?>
				<h5 class="card-title text-center">{{ $user->currentPage() }}<br/> Dari <br/> {{ $user->lastPage() }}</h5>
				
				<?php } ?>

				</div>
				
            </div>
		</div>
		<?php if(old('kriteria') === "1") {?> 
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Pengguna Aktif</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->where('active_status','=',"1")->count()}}</h5>
                </div>
            </div>
		</div>
		<?php } else if(old('kriteria') === "0") {?>
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Pengguna Tidak Aktif</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->where('active_status','=',"0")->count()}}</h5>
                </div>
            </div>
		</div>
		<?php }else{ ?> 
		<div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Pengguna Aktif</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->where('active_status','=',"1")->count()}}</h5>
                </div>
            </div>
		</div>
		<div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Pengguna Tidak Aktif</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->where('active_status','=',"0")->count()}}</h5>
                </div>
            </div>
		</div>
		<?php } ?>
        </div>
        </div>

    </div>

<div class="m-5">
<div class="card mt-5">

<div class="card-header text-center">
                <h5>
					Data Pengguna Aplikasi REKUSAHA  
                    {{ (old('kriteria') === "1" ? "Berstatus Aktif" : (old('kriteria') === "0" ?"Berstatus Tidak Aktif" : ""))}}
					
                </h5>
                </div>
                <div class="card-body">
				<form action="/user" method="POST" class="text-right">
                {{ csrf_field() }}
             <input name="cari" type="hidden" value= "{{old('cari') }}">
			 <input name="jenis" type="hidden" value= "{{ old('jenis') }}">

				<select name="kriteria" onchange='this.form.submit()'>
				<option value="" disabled selected>Filter jenis usaha </option>
				@foreach($User->unique('active_status') as $p)	
                <option value="{{$p->active_status}}" {{(old('kriteria') === $p->active_status."" ? "selected":"") }}>{{($p->active_status == 1 ? "Aktif" : "Tidak Aktif")}}</option>
				@endforeach

                <!-- <input class="btn btn-primary" type="submit" value="Simpan Data"> -->
                </select>
                </form>
<br/>

	<form action="/user/search" id="carikan" method="GET" class="text-right">
    <div class="col-md-4">
    <input name="jenis" type="hidden" value= "{{ old('kriteria') }}">
    <input name="kriteria" type="hidden" value= "{{ old('kriteria') }}">

		
    </div>
		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   value="{{old('cari')}}">{{( old('cari') == "" ? "Pilih Pencarian" : old('cari') )}}</button>
            <div class="dropdown-menu">
            <div role="separator" class="dropdown-divider" ></div>
            <a class="dropdown-item" href="/user/search?jenis={{old('kriteria')}}&cari=id_user&kriteria={{old('kriteria')}}" >ID User
            </a>
            <a class="dropdown-item"  href="/user/search?jenis={{old('kriteria')}}&cari=nama&kriteria={{old('kriteria')}}">Nama
        </a>
            <a class="dropdown-item" href="/user/search?jenis={{old('kriteria')}}&cari=email&kriteria={{old('kriteria')}}">Email
             </a>
             <input name="cari" type="hidden" value= "{{old('cari') }}">
            </div>
        </div>
        <input type="text" class="form-control" aria-label="Text input with dropdown button"  name="search" placeholder="Cari {{old('cari')}} .." value="{{ old('search') }}" onchange='this.form.submit()'>
        <!-- <input type="text" class="form-control" aria-label="Text input with dropdown button"> -->
        </div>

		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
    
	</form>
    
    <div class="text-right">
    <a href="/user/export_excel" class="btn btn-success my-3" target="_blank"><img src="/images/excel.png" width="20" height="20" class="d-inline-block align-top" alt=""> EXPORT EXCEL</a>
		
    <?php if(old('kriteria') != ""){ ?>
    <a href="/user/cetak_pdf/{{old('kriteria')}}#" class="btn btn-danger" target="_blank"><img src="/images/pdf.png" width="20" height="20" class="d-inline-block align-top" alt=""> CETAK PDF </a>
    <?php } ?>
    </div>
<br/>
    <font size="1">

	<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>ID User</th>
			<th>Nama</th>
			<th>Password</th>
			<th>Token</th>
			<th>Email</th>
            <th>Status Aktif</th>
            <th>No Verifikasi</th>
            <th>Waktu akun diupdate</th>
            <th>Waktu akun dibuat</th>
            <th>Opsi</th>
            

		</tr>
		@foreach($user as $p)
		<tr>
			<td>{{ $p->id_user }}</td>
			<td>{{ $p->nama }}</td>
			<td>{{ $p->password }}</td>
			<td>{{ $p->token }}</td>
            <td>{{ $p->email }}</td>
			<td>{{ ($p->active_status == 0 ? "Belum Aktif" : "Aktif" ) }}</td>
			<td>{{ $p->verification }}</td>
			<td>{{ $p->updated_at }}</td>
            <td>{{ $p->created_at }}</td>

			<td>
			<a class="btn btn-danger btn-sm" onclick="confirmDelete('{{$p->no}}')"><img src="/images/trash.png" width="17" height="17" class="d-inline-block align-top" alt=""> Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>
	</font>
	<br/>
 
 
	{{ $user->links() }}
	</div>
		</div>
	</div>
</body>
</html>