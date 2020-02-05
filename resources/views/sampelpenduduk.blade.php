<!DOCTYPE html>
<html>
<head>
<title>Laman Sampel Penduduk - Rekusaha</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="chartjs/Chart.js"></script>

</head>
<body>
    
    <!-- <script>swal("Good job!", "You clicked the button!", "success");</script> -->
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
        <a class="nav-link active" href="#">Sampel Penduduk</a>
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
        function confirmDelete(nilai) {
            swal({
                 title: 'Apakah Anda Yakin?',
                  text: "Anda Tidak Akan Dapat Mengembalikannya!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="/sampelpenduduk/delete/"+nilai;
                       
                    } else {
                        swal("Perintah dibatalkan");
                    }
                });
        }
        function downloadPDF(jenis){
            var value = "Data Alternatif berdasarkan ";
            swal("Data mana yang ingin didownload? ", {
            icon : "warning",
            buttons: {
                
                dua: {
                text: "Data Alternatif",
                value: "dua",
                },
                satu: {
                text: value.concat(jenis),
                value: "satu",
                },
            },
            })
            .then((value) => {
            switch (value) {
            
                case "dua":
                window.location.href="/sampelpenduduk/export_excel/"+"data";
                
                break;
            
                case "satu":
                window.location.href="/sampelpenduduk/export_excel/"+jenis;
                
                break;
            
                default:
                break;
                
            }
            });
        }
    </script>
    <br/>
    <br/>
    <div class="row justify-content-md-right">
        <div class="col-12  ml-5 mr-5 mt-5">
        <div class="row justify-content-md-right">
            <div class="col-9">
            
            <div class="card text-white bg-light text-left text-dark" style="width: 750px;height: 430px">
            <div class="input-group mb-3">
            <form action="/sampelpenduduk" method="POST" class="text-right">
            {{ csrf_field() }}
            <input name="jenis" type="hidden" value= "{{old('kriteria') }}">
            <input name="kriteria" type="hidden" value= "{{old('kriteria') }}">
            
                <div class="input-group-append mt-1 ml-2 mr-2">
                <input type="text" name="chart" value="{{old('chart')}}" class="form-control" placeholder="Masukan ID Alternatif" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input class="btn btn-outline-secondary ml-2" type="submit" value="Cari" />
                </div>
                </form>
                
                </div>
            <canvas id="myChart"></canvas>
            </div>
 
 

	<script>
            <?php 
            $ide=old('chart');
            
            if($ide === null){
                $i = 0;
                $ide ="A01";

            }else{
                $i= substr(old('chart'), 1)-1;
            }
            ?>
            
        var jenis = "{{$jenis}}";
        var ctx = document.getElementById("myChart").getContext('2d');
        if (jenis == "jk_al"){
        var label = ["pria","wanita"];
        var value = [{{ $chart[$i]->jk_al->pria }},{{ $chart[$i]->jk_al->wanita }}];
        }
        if (jenis == "sk_al"){
        var label = ['belum_kawin','kawin','cerai_hidup','cerai_mati'];
        var value = [{{ $chart[$i]->sk_al->belum_kawin }},{{ $chart[$i]->sk_al->kawin }},{{ $chart[$i]->sk_al->cerai_hidup }},{{ $chart[$i]->sk_al->cerai_mati }}];
        }
        if (jenis == "pekerjaan_al"){
        var label = ['tidak_bekerja','aparat_pejabat_negara','tenaga_pengajar','wiraswasta','pertanian','nelayan','bidang_keagamaan','pelajar_dan_mahasiswa','tenaga_kesehatan','pensiunan','lainnya'];
        var value = [{{ $chart[$i]->pekerjaan_al->tidak_bekerja }}
                        ,{{ $chart[$i]->pekerjaan_al->aparat_pejabat_negara }}
                        ,{{ $chart[$i]->pekerjaan_al->tenaga_pengajar }}
                        ,{{ $chart[$i]->pekerjaan_al->wiraswasta }}
                        ,{{ $chart[$i]->pekerjaan_al->pertanian }}
                        ,{{ $chart[$i]->pekerjaan_al->nelayan }}
                        ,{{ $chart[$i]->pekerjaan_al->bidang_keagamaan }}
                        ,{{ $chart[$i]->pekerjaan_al->pelajar_dan_mahasiswa }}
                        ,{{ $chart[$i]->pekerjaan_al->tenaga_kesehatan }}
                        ,{{ $chart[$i]->pekerjaan_al->pensiunan }}
                        ,{{ $chart[$i]->pekerjaan_al->lainnya }}];
              
        }
        if (jenis == "pendidikan_al"){
        var label = ['belum_sekolah','belum_tamat_sd','tamat_sd','smp','sma','di_dii','diii','s1','s2','s3'];
        var value = [{{ $chart[$i]->pendidikan_al->belum_sekolah }},{{ $chart[$i]->pendidikan_al->belum_tamat_sd }},{{ $chart[$i]->pendidikan_al->tamat_sd }},{{ $chart[$i]->pendidikan_al->smp }},{{ $chart[$i]->pendidikan_al->sma }},{{ $chart[$i]->pendidikan_al->di_dii }},{{ $chart[$i]->pendidikan_al->diii }},{{ $chart[$i]->pendidikan_al->s1 }},{{ $chart[$i]->pendidikan_al->s2 }},{{ $chart[$i]->pendidikan_al->s3 }}];
             
        }
        if (jenis == "umur_al"){
        var label = ['u0_4','u5_9','u10_14','u15_19','u20_24','u25_29','u30_34','u35_39','u40_44','u45_49','u50_54','u55_59','u60_64','u65_69','u70_74','u75_above'];
        var value = [{{ $chart[$i]->umur_al->u0_4 }},
                     {{ $chart[$i]->umur_al->u5_9 }},
                     {{ $chart[$i]->umur_al->u10_14 }},
                            {{ $chart[$i]->umur_al->u15_19 }},
                            {{ $chart[$i]->umur_al->u20_24 }},
                            {{ $chart[$i]->umur_al->u25_29 }},
                            {{ $chart[$i]->umur_al->u30_34 }},
                            {{ $chart[$i]->umur_al->u35_39 }},
                            {{ $chart[$i]->umur_al->u40_44 }},
                            {{ $chart[$i]->umur_al->u45_49 }},
                            {{ $chart[$i]->umur_al->u50_54 }},
                            {{ $chart[$i]->umur_al->u55_59 }},
                            {{ $chart[$i]->umur_al->u60_64 }},
                            {{ $chart[$i]->umur_al->u65_69 }},
                            {{ $chart[$i]->umur_al->u70_74 }},
                            {{ $chart[$i]->umur_al->u75_above }}]; 
                     
        }
        if (jenis == "rek_harga"){
        var label = ['h5_10','h10_15','h15_20','h20_25','h25_30','h30_abv'];
        var value = [{{ $chart[$i]->rek_harga->h5_10 }},{{ $chart[$i]->rek_harga->h10_15 }},{{ $chart[$i]->rek_harga->h15_20 }},{{ $chart[$i]->rek_harga->h20_25 }}{{ $chart[$i]->rek_harga->h25_30 }},{{ $chart[$i]->rek_harga->h30_abv }}];                      
        }
        var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					label: 'Data '+jenis+" dari Alternatif "+"{{$ide}} Dengan banyak sampel penduduk : "+{{$chart[$i]->banyak_sample}},
					data: value,
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
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Halaman </div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $sampelpenduduk->currentPage() }}<br/> Dari {{ $sampelpenduduk->lastPage() }}</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Data</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$sampelpenduduk->total()}}</h5>
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
                    Data Sampel Penduduk Kota Bandung Berdasarkan <?php 
                    if($jenis == "jk_al")echo "Jenis Kelamin";
                    if($jenis == "sk_al")echo "Status Kawin";
                    if($jenis == "pendidikan_al")echo "Pendidikan";
                    if($jenis == "pekerjaan_al")echo "Pekerjaan";
                    if($jenis == "umur_al")echo "Umur";   
                    if($jenis == "rek_harga")echo "Rekomendasi Harga";  ?> 

                </h5>
                
                </div>
                <div class="card-body">

<form action="/sampelpenduduk" method="POST" class="text-right">
{{ csrf_field() }}
<input name="cari" type="hidden" value= "{{old('cari') }}">

<select name="kriteria" onchange='this.form.submit()'>
<option value="jk_al" {{ ($jenis == "jk_al" ? "selected":"") }}>Jenis Kelamin</option>
<option value="sk_al" {{ ($jenis == "sk_al" ? "selected":"") }}>Status Kawin</option>
<option value="pendidikan_al" {{ ($jenis == "pendidikan_al" ? "selected":"") }}>Pendidikan</option>
<option value="pekerjaan_al" {{ ($jenis == "pekerjaan_al" ? "selected":"") }}>Pekerjaan</option>
<option value="umur_al" {{ ($jenis == "umur_al" ? "selected":"") }}>Umur</option>
<option value="rek_harga" {{ ($jenis == "rek_harga" ? "selected":"") }}>Rekomendasi Harga</option>

</select>
</form>

<a href="/sampelpenduduk/add" ><button type="button" class="btn btn-primary btn-sm"> + Tambah Sampel Penduduk</button></a>
	
	<br/>
	<br/>
	<form action="/sampelpenduduk/search" id="carikan" method="GET" class="text-right">
    <div class="col-md-4">
    <input name="jenis" type="hidden" value= "{{ $jenis }}">

		
    </div>
		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   value="{{old('cari')}}">{{( old('cari') == "" ? "Pilih Pencarian" : old('cari') )}}</button>
            <div class="dropdown-menu">
            <div role="separator" class="dropdown-divider" ></div>
            <a class="dropdown-item" href="/sampelpenduduk/search?jenis={{$jenis}}&cari=id_alternatif" >Id Alternatif
            

            </a>
            <a class="dropdown-item"  href="/sampelpenduduk/search?jenis={{$jenis}}&cari=nama_alternatif">Nama Alternatif
            
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

    <?php if($jenis != ""){ ?>
    <a onclick="downloadPDF('{{$jenis}}')" href="#" class="btn btn-success my-3" ><img src="/images/excel.png" width="20" height="20" class="d-inline-block align-top" alt=""> EXPORT EXCEL</a>

    <a href="/sampelpenduduk/cetak_pdf/{{$jenis}}#" class="btn btn-danger" target="_blank"><img src="/images/pdf.png" width="20" height="20" class="d-inline-block align-top" alt=""> CETAK PDF </a>
    <?php } ?>
    </div>

	<br/>
    <font size="1">
	<table class="table table-bordered table-hover table-striped text-center">
		
        <tr>
        
			<th>Id Alternatif</th>
			<th>Nama Alternatif</th>
			<th>Banyak Sampel</th>
			<th>ID rekomendasi Harga</th>
        <?php
        if ($jenis == "jk_al"){

        
        ?>
        	<th>Pria</th>
            <th>Wanita</th>
        <?php    
        }else if ($jenis == "sk_al"){
        ?>
        	<th>Belum Kawin</th>
            <th>Kawin</th>
            <th>Cerai Hidup</th>
            <th>Cerai Mati</th>
        <?php
        }else if ($jenis == "pendidikan_al"){
            ?>
                <th>Belum Sekolah</th>
                <th>Belum Tamat SD</th>
                <th>SD</th>
                <th>SMP</th>
                <th>SMA</th>
                <th>DI dan DII</th>
                <th>DIII</th>
                <th>S1</th>
                <th>S2</th>
                <th>S3</th>
                
            <?php
            }else if ($jenis == "pekerjaan_al"){
                ?>
                    <th>Tidak Bekerja</th>
                    <th>Aparat Pejabat Negara</th>
                    <th>Tenaga Pengajar</th>
                    <th>Wiraswasta</th>
                    <th>Bidang Pertanian</th>
                    <th>Nelayan</th>
                    <th>Bidang Keagamaan</th>
                    <th>Pelajar dan Mahasiswa</th>
                    <th>Tenaga Kesehatan</th>
                    <th>Pensiunan</th>
                    <th>Lainnya</th>
                    
                <?php
                }else if ($jenis == "umur_al"){
                    ?>
                        <th>0-4 Tahun</th>
                        <th>5-9 Tahun</th>
                        <th>10-14 Tahun</th>
                        <th>15-19 Tahun</th>
                        <th>20-24 Tahun</th>
                        <th>25-29 Tahun</th>
                        <th>30-34 Tahun</th>
                        <th>35-39 Tahun</th>
                        <th>40-44 Tahun</th>
                        <th>45-49 Tahun</th>
                        <th>50-54 Tahun</th>
                        <th>55-59 Tahun</th>
                        <th>60-64 Tahun</th>
                        <th>65-69 Tahun</th>
                        <th>70-74 Tahun</th>
                        <th>75 Tahun Keatas</th>
                        
                        
                    <?php
                    }else if ($jenis == "rek_harga"){
                        ?>
                            <th>5-10 Ribu</th>
                            <th>10-15 Ribu</th>
                            <th>15-20 Ribu</th>
                            <th>20-25 Ribu</th>
                            <th>25-30 Ribu</th>
                            <th>30 Ribu Keatas</th>
                            
                        <?php
                        }else{
            
                    }
        ?>
        <th>Opsi</th>
		</tr>
		@foreach($sampelpenduduk as $p)
		<tr>
			<td>{{ $p->id_alternatif }}</td>
			<td>{{ $p->nama_alternatif }}</td>
			<td>{{ $p->banyak_sample }}</td>
			<td>{{ $p->id_rharga }}</td>
            <?php
            if ($jenis == "jk_al"){
            ?>  
            
                <td>{{ $p->jk_al->pria }}</td>
			<td>{{ $p->jk_al->wanita }}</td>
                
                <?php
            
            }else if ($jenis == "sk_al"){
                ?>  
                
                <td>{{ $p->sk_al->belum_kawin }}</td>
                <td>{{ $p->sk_al->kawin }}</td>
                <td>{{ $p->sk_al->cerai_hidup }}</td>
                <td>{{ $p->sk_al->cerai_mati }}</td>
                    
                    <?php
                
                } else if ($jenis == "pendidikan_al"){
                    ?>  
                    
                    <td>{{ $p->pendidikan_al->belum_sekolah }}</td>
                    <td>{{ $p->pendidikan_al->belum_tamat_sd }}</td>
                    <td>{{ $p->pendidikan_al->tamat_sd }}</td>
                    <td>{{ $p->pendidikan_al->smp }}</td>
                    <td>{{ $p->pendidikan_al->sma }}</td>
                    <td>{{ $p->pendidikan_al->di_dii }}</td>
                    <td>{{ $p->pendidikan_al->diii }}</td>
                    <td>{{ $p->pendidikan_al->s1 }}</td>
                    <td>{{ $p->pendidikan_al->s2 }}</td>
                    <td>{{ $p->pendidikan_al->s3 }}</td>
                        
                        <?php
                    
                    } else if ($jenis == "pekerjaan_al"){
                        ?>  
                        
                        <td>{{ $p->pekerjaan_al->tidak_bekerja }}</td>
                        <td>{{ $p->pekerjaan_al->aparat_pejabat_negara }}</td>
                        <td>{{ $p->pekerjaan_al->tenaga_pengajar }}</td>
                        <td>{{ $p->pekerjaan_al->wiraswasta }}</td>
                        <td>{{ $p->pekerjaan_al->pertanian }}</td>
                        <td>{{ $p->pekerjaan_al->nelayan }}</td>
                        <td>{{ $p->pekerjaan_al->bidang_keagamaan }}</td>
                        <td>{{ $p->pekerjaan_al->pelajar_dan_mahasiswa }}</td>
                        <td>{{ $p->pekerjaan_al->tenaga_kesehatan }}</td>
                        <td>{{ $p->pekerjaan_al->pensiunan }}</td>
                        <td>{{ $p->pekerjaan_al->lainnya }}</td>
                            
                            
                            <?php
                        
                        } else if ($jenis == "umur_al"){
                            ?>  
                            
                            <td>{{ $p->umur_al->u0_4 }}</td>
                            <td>{{ $p->umur_al->u5_9 }}</td>
                            <td>{{ $p->umur_al->u10_14 }}</td>
                            <td>{{ $p->umur_al->u15_19 }}</td>
                            <td>{{ $p->umur_al->u20_24 }}</td>
                            <td>{{ $p->umur_al->u25_29 }}</td>
                            <td>{{ $p->umur_al->u30_34 }}</td>
                            <td>{{ $p->umur_al->u35_39 }}</td>
                            <td>{{ $p->umur_al->u40_44 }}</td>
                            <td>{{ $p->umur_al->u45_49 }}</td>
                            <td>{{ $p->umur_al->u50_54 }}</td>
                            <td>{{ $p->umur_al->u55_59 }}</td>
                            <td>{{ $p->umur_al->u60_64 }}</td>
                            <td>{{ $p->umur_al->u65_69 }}</td>
                            <td>{{ $p->umur_al->u70_74 }}</td>
                            <td>{{ $p->umur_al->u75_above }}</td>
                            
                                
                               
                                <?php
                            
                            } else if ($jenis == "rek_harga"){
                                ?>
                                    <td>{{ $p->rek_harga->h5_10 }}</td>
                                    <td>{{ $p->rek_harga->h10_15 }}</td>
                                    <td>{{ $p->rek_harga->h15_20 }}</td>
                                    <td>{{ $p->rek_harga->h20_25 }}</td>
                                    <td>{{ $p->rek_harga->h25_30 }}</td>
                                    <td>{{ $p->rek_harga->h30_abv }}</td>
                                    
                                <?php
                                }else{
            
                            }
            ?>
            
			
			<td>
				<a class="btn btn-warning btn-sm" href="/sampelpenduduk/edit/{{ $p->id_alternatif }}"><img src="/images/edit.png" width="17" height="17" class="d-inline-block align-top" alt=""> Edit </a>
				<a class="btn btn-danger btn-sm" onclick="confirmDelete('{{$p->id_alternatif}}')"><img src="/images/trash.png" width="17" height="17" class="d-inline-block align-top" alt=""> Hapus</a>
            
            </td>
		</tr>
		@endforeach
	</table>
    </font>
	<br/>
 
 
	{{ $sampelpenduduk->links() }}
	</div>
		</div>
	</div>
</body>
</html>