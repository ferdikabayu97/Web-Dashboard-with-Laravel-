<!DOCTYPE html>
<html>
<head>
	<title>Laman UMKM - Rekusaha</title>
	<link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="chartjs/Chart.js"></script>
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
        <a class="nav-link active" href="#">UMKM </a>
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
                        window.location.href="/umkm/delete/"+item;
                       
                    } else {
                        swal("Perintah dibatalkan");
                    }
                });
        }
    </script>
  
   
    <br/>
    <br/>
    <div class="row justify-content-md-right">
    <div class="col-12  ml-5 mr-5 mt-5">
     
        
   

     <div class="row justify-content-md-right">
         <div class="col-7">
         
         <div class="card text-white bg-light text-left text-dark" style="width: 750px;height: 430px">
         <div class="input-group mb-3">
         
             
             </div>
             <?php
                    $a = array();
                    ?>
                    @foreach($ju as $p)	
					<?php 
                    
                    $a[] = $p->nama_alternatif;
                    
                      ?> 
				@endforeach
         <canvas id="myChart"></canvas>
         </div>
         <script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($a)?>,
				datasets: [{
					label: '# Banyak usaha sesuai Jenis usaha',
					data: <?php echo json_encode($nilai)?>,
					// backgroundColor: [
					// 'rgba(255, 99, 132, 0.2)',
					// 'rgba(54, 162, 235, 0.2)',
					// 'rgba(255, 206, 86, 0.2)',
					// 'rgba(75, 192, 192, 0.2)',
					// 'rgba(153, 102, 255, 0.2)',
					// 'rgba(255, 159, 64, 0.2)',
					// 'rgba(121, 71, 251, 0.2)',
					// 'rgba(255, 151, 61, 0.2)'
					// ],
					// borderColor: [
					// 'rgba(255,99,132,1)',
					// 'rgba(54, 162, 235, 1)',
					// 'rgba(255, 206, 86, 1)',
					// 'rgba(75, 192, 192, 1)',
					// 'rgba(153, 102, 255, 1)',
					// 'rgba(255, 159, 64, 1)',
					// 'rgba(121, 71, 251, 1)',
					// 'rgba(255, 151, 61, 1)'
					// ],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
         </div>
         <div class="row justify-content-md-left">
        <div class="col">
        <br/>
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Halaman </div>
                <div class="card-body">
                 <h5 class="card-title text-center">{{ $umkm->currentPage() }}<br/> Dari {{ $umkm->lastPage() }}</h5>
                </div>
            </div>
        </div>
        <div class="col">
        <br/>

            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Data</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$umkm->total()}}</h5>
                </div>
            </div>
		</div>
		
        <div class="col">
        <br/>
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jenis Usaha</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{( (old('kriteria') != "") ? old('kriteria') : $ju->count())}}</h5>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

    </div>

<div class="m-5">
<div class="card mt-5">
                <div class="card-header text-center">
                <h5>
                
					Data UMKM Kota Bandung  
					@foreach($ju as $p)	
					<?php 
                    if(old('kriteria') == $p->nama_alternatif)echo "Berjenis Usaha ".$p->nama_alternatif;
                      ?> 
				@endforeach
					
                </h5>
                
                </div>
                <div class="card-body">
				<form action="/umkm" method="POST" class="text-right">
                {{ csrf_field() }}
             <input name="cari" type="hidden" value= "{{old('cari') }}">
			 <input name="jenis" type="hidden" value= "{{ old('jenis') }}">

				<select name="kriteria" onchange='this.form.submit()'>
				<option value="" disabled selected>Filter jenis usaha </option>
				@foreach($ju as $p)	
                <option value="{{$p->nama_alternatif}}" {{ (old('kriteria') == $p->nama_alternatif ? "selected":"") }}>{{$p->nama_alternatif}}</option>
				@endforeach

                <!-- <input class="btn btn-primary" type="submit" value="Simpan Data"> -->
                </select>
                </form>

				<a href="/umkm/add" ><button type="button" class="btn btn-primary btn-sm"> + Tambah Data UMKM</button></a>
	<br/>
	<br/>
	<form action="/umkm/search" id="carikan" method="GET" class="text-right">
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
            <a class="dropdown-item" href="/umkm/search?jenis={{old('kriteria')}}&cari=no&kriteria={{old('kriteria')}}" >No
            </a>
            <a class="dropdown-item"  href="/umkm/search?jenis={{old('kriteria')}}&cari=nama_perusahaan&kriteria={{old('kriteria')}}">Nama Perusahaan
        </a>
            <a class="dropdown-item" href="/umkm/search?jenis={{old('kriteria')}}&cari=nama_pemilik&kriteria={{old('kriteria')}}">Nama Pemilik
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
    <a href="/umkm/export_excel" class="btn btn-success my-3" target="_blank"><img src="/images/excel.png" width="20" height="20" class="d-inline-block align-top" alt=""> EXPORT EXCEL</a>
    <a href="/umkm/cetak_pdf/#" class="btn btn-danger" target="_blank"><img src="/images/pdf.png" width="20" height="20" class="d-inline-block align-top" alt=""> CETAK PDF </a>
    </div>
<br/>
	<table class="table table-bordered table-hover table-striped text-center">
		<tr>
			<th>No</th>
			<th>Nama Perusahaan</th>
			<th>Nama Pemilik</th>
			<th>Alamat</th>
			<th>Telpon</th>
            <th>Jenis Usaha</th>
            <th>Jumlah</th>
            <th>Aset</th>
            <th>Omset</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Tahun</th>
            <th>Status Usaha</th>
			<th>Opsi</th>


		</tr>
		@foreach($umkm as $p)
		<tr>
			<td>{{ $p->no }}</td>
			<td>{{ $p->nama_perusahaan }}</td>
			<td>{{ $p->nama_pemilik }}</td>
			<td>{{ $p->alamat }}</td>
            <td>{{ $p->telp }}</td>
			<td>{{ $p->jenis_usaha }}</td>
			<td>{{ $p->jumlah }}</td>
			<td>{{ $p->aset }}</td>
            <td>{{ $p->omset }}</td>
			<td>{{ $p->kelurahan }}</td>
			<td>{{ $p->kecamatan }}</td>
			<td>{{ $p->tahun }}</td>
			<td>{{ $p->ket }}</td>

			<td>
				<a class="btn btn-warning btn-sm" href="/umkm/edit/{{ $p->no }}"><img src="/images/edit.png" width="17" height="17" class="d-inline-block align-top" alt=""> Edit </a>
				<a class="btn btn-danger btn-sm" onclick="confirmDelete('{{$p->no}}')"><img src="/images/trash.png" width="17" height="17" class="d-inline-block align-top" alt=""> Hapus</a>
            
            </td>
		</tr>
		@endforeach
	</table>
	</font>
	<br/>
	{{ $umkm->links() }}
	</div>
		</div>
	</div>
</body>
</html>