<!DOCTYPE html>
<html>
<head>
    <title>Laman Penduduk - Rekusaha</title>
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
        <a class="nav-link" href="/umkm">UMKM </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Penduduk </a>
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
                        window.location.href="/penduduk/delete/"+item;
                       
                    } else {
                        swal("Perintah dibatalkan");
                    }
                });
                   
        }
        function downloadPDF(jenis){
            var value = "Data Penduduk berdasarkan ";
            swal("Data mana yang ingin didownload? ", {
            icon : "warning",
            buttons: {
                
                dua: {
                text: "Data Penduduk",
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
                window.location.href="/penduduk/export_excel/"+"data";
                
                break;
            
                case "satu":
                window.location.href="/penduduk/export_excel/"+jenis;
                
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
            <form action="/penduduk" method="POST" class="text-right">
            {{ csrf_field() }}
            <input name="jenis" type="hidden" value= "{{old('kriteria') }}">
            <input name="kriteria" type="hidden" value= "{{old('kriteria') }}">
            
                <div class="input-group-append mt-1 ml-2 mr-2">
                <input type="text" name="chart" value="{{old('chart')}}" class="form-control" placeholder="Masukan ID Lokasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                $ide =1;
            }else{
                $i=old('chart')-1;
            }
            // dd($i);
            ?>
            
        var jenis = "{{$jenis}}";
        var ctx = document.getElementById("myChart").getContext('2d');
        if (jenis == "jk"){
        var label = ["pria","wanita"];
        var value = [{{ $chart[$i]->jk->pria }},{{ $chart[$i]->jk->wanita }}];
        }
        if (jenis == "sk"){
        var label = ['belum_kawin','kawin','cerai_hidup','cerai_mati'];
        var value = [{{ $chart[$i]->sk->belum_kawin }},{{ $chart[$i]->sk->kawin }},{{ $chart[$i]->sk->cerai_hidup }},{{ $chart[$i]->sk->cerai_mati }}];
        }
        if (jenis == "pekerjaan"){
        var label = ['tidak_bekerja','aparat_pejabat_negara','tenaga_pengajar','wiraswasta','pertanian','nelayan','bidang_keagamaan','pelajar_dan_mahasiswa','tenaga_kesehatan','pensiunan','lainnya'];
        var value = [{{ $chart[$i]->pekerjaan->tidak_bekerja }}
                        ,{{ $chart[$i]->pekerjaan->aparat_pejabat_negara }}
                        ,{{ $chart[$i]->pekerjaan->tenaga_pengajar }}
                        ,{{ $chart[$i]->pekerjaan->wiraswasta }}
                        ,{{ $chart[$i]->pekerjaan->pertanian }}
                        ,{{ $chart[$i]->pekerjaan->nelayan }}
                        ,{{ $chart[$i]->pekerjaan->bidang_keagamaan }}
                        ,{{ $chart[$i]->pekerjaan->pelajar_dan_mahasiswa }}
                        ,{{ $chart[$i]->pekerjaan->tenaga_kesehatan }}
                        ,{{ $chart[$i]->pekerjaan->pensiunan }}
                        ,{{ $chart[$i]->pekerjaan->lainnya }}];
              
        }
        if (jenis == "pendidikan"){
        var label = ['belum_sekolah','belum_tamat_sd','tamat_sd','smp','sma','di_dii','diii','s1','s2','s3'];
        var value = [{{ $chart[$i]->pendidikan->belum_sekolah }},{{ $chart[$i]->pendidikan->belum_tamat_sd }},{{ $chart[$i]->pendidikan->tamat_sd }},{{ $chart[$i]->pendidikan->smp }},{{ $chart[$i]->pendidikan->sma }},{{ $chart[$i]->pendidikan->di_dii }},{{ $chart[$i]->pendidikan->diii }},{{ $chart[$i]->pendidikan->s1 }},{{ $chart[$i]->pendidikan->s2 }},{{ $chart[$i]->pendidikan->s3 }}];
             
        }
        if (jenis == "umur"){
        var label = ['u0_4','u5_9','u10_14','u15_19','u20_24','u25_29','u30_34','u35_39','u40_44','u45_49','u50_54','u55_59','u60_64','u65_69','u70_74','u75_above'];
        var value = [{{ $chart[$i]->umur->u0_4 }},
                     {{ $chart[$i]->umur->u5_9 }},
                     {{ $chart[$i]->umur->u10_14 }},
                            {{ $chart[$i]->umur->u15_19 }},
                            {{ $chart[$i]->umur->u20_24 }},
                            {{ $chart[$i]->umur->u25_29 }},
                            {{ $chart[$i]->umur->u30_34 }},
                            {{ $chart[$i]->umur->u35_39 }},
                            {{ $chart[$i]->umur->u40_44 }},
                            {{ $chart[$i]->umur->u45_49 }},
                            {{ $chart[$i]->umur->u50_54 }},
                            {{ $chart[$i]->umur->u55_59 }},
                            {{ $chart[$i]->umur->u60_64 }},
                            {{ $chart[$i]->umur->u65_69 }},
                            {{ $chart[$i]->umur->u70_74 }},
                            {{ $chart[$i]->umur->u75_above }}]; 
                     
        }
        var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: label,
				datasets: [{
					label: 'Data '+jenis+" dari lokasi ke-"+{{$ide}}+" Dengan Total Penduduk : "+{{$chart[$i]->banyak_penduduk}},
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
        <br/>
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Halaman </div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $penduduk->currentPage() }}<br/> Dari {{ $penduduk->lastPage() }}</h5>
                </div>
            </div>
        </div>
        <div class="col">
        <br/>
        
            <div class="card text-white bg-light text-right text-dark" style="max-width: 8rem; ">
                <div class="card-header text-center">Jumlah Data</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$penduduk->total()}}</h5>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

    </div>

<div class=" m-5">
            <div class="card mt-5">
                <div class="card-header text-center">
                <h5>
                    Data Penduduk Kota Bandung Berdasarkan <?php 
                    if($jenis == "jk")echo "Jenis Kelamin";
                    if($jenis == "sk")echo "Status Kawin";
                    if($jenis == "pendidikan")echo "Pendidikan";
                    if($jenis == "pekerjaan")echo "Pekerjaan";
                    if($jenis == "umur")echo "Umur";  ?> 
                </h5>
                
                </div>

<div class="card-body">
                <form action="/penduduk" method="POST" class="text-right">
                {{ csrf_field() }}
             <input name="cari" type="hidden" value= "{{old('cari') }}">

                <select name="kriteria" onchange='this.form.submit()'>
                <option value="jk" {{ ($jenis == "jk" ? "selected":"") }}>Jenis Kelamin</option>
                <option value="sk" {{ ($jenis == "sk" ? "selected":"") }}>Status Kawin</option>
                <option value="pendidikan" {{ ($jenis == "pendidikan" ? "selected":"") }}>Pendidikan</option>
                <option value="pekerjaan" {{ ($jenis == "pekerjaan" ? "selected":"") }}>Pekerjaan</option>
                <option value="umur" {{ ($jenis == "umur" ? "selected":"") }}>Umur</option>

                <!-- <input class="btn btn-primary" type="submit" value="Simpan Data"> -->
                </select>
                </form>

    <a href="/penduduk/add" ><button type="button" class="btn btn-primary btn-sm"> + Tambah Data Penduduk</button></a>
	<br/>
	<br/>
	<form action="/penduduk/search" id="carikan" method="GET" class="text-right">
    <div class="col-md-4">
    <input name="jenis" type="hidden" value= "{{ $jenis }}">

		
    </div>
		<!-- <input class="btn btn-primary ml-3" type="submit" value="CARI"> -->
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   value="{{old('cari')}}">{{( old('cari') == "" ? "Pilih Pencarian" : old('cari') )}}</button>
            <div class="dropdown-menu">
            <div role="separator" class="dropdown-divider" ></div>
            <a class="dropdown-item" href="/penduduk/search?jenis={{$jenis}}&cari=id_lokasi" >Id Lokasi
            

            </a>
            <a class="dropdown-item"  href="/penduduk/search?jenis={{$jenis}}&cari=kecamatan">Kecamatan
            
        </a>
            <a class="dropdown-item" href="/penduduk/search?jenis={{$jenis}}&cari=kelurahan">Kelurahan
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

    <a href="/penduduk/cetak_pdf/{{$jenis}}#" class="btn btn-danger" target="_blank"><img src="/images/pdf.png" width="20" height="20" class="d-inline-block align-top" alt=""> CETAK PDF </a>
    <?php } ?>
    </div>
    <br/>
	
	
    <font size="1">
	<table class="table table-bordered table-hover table-striped text-center">
		
        <tr>
        
			<th>Id Lokasi</th>
			<th>Kecamatan</th>
			<th>Kelurahan</th>
			<th>Banyak Penduduk</th>
        <?php
        if ($jenis == "jk"){

        
        ?>
        	<th>Pria</th>
            <th>Wanita</th>
        <?php    
        }else if ($jenis == "sk"){
        ?>
        	<th>Belum Kawin</th>
            <th>Kawin</th>
            <th>Cerai Hidup</th>
            <th>Cerai Mati</th>
        <?php
        }else if ($jenis == "pendidikan"){
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
            }else if ($jenis == "pekerjaan"){
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
                }else if ($jenis == "umur"){
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
                    }else{
            
                    }
        ?>
        <th>Opsi</th>
		</tr>
		@foreach($penduduk as $p)
		<tr>
			<td>{{ $p->id_lokasi }}</td>
			<td>{{ $p->kecamatan }}</td>
			<td>{{ $p->kelurahan }}</td>
			<td>{{ $p->banyak_penduduk }}</td>
            <?php
            if ($jenis == "jk"){
            ?>  
            <?php
            if($p->kelurahan != ""){
                ?>
                <td>{{ $p->jk->pria }}</td>
			<td>{{ $p->jk->wanita }}</td>
                <?php
            }else{
                ?>
                <td>-</td>
			    <td>-</td>
                <?php
            }
            }else if ($jenis == "sk"){
                ?>  
                <?php
                if($p->kelurahan != ""){
                    ?>
                <td>{{ $p->sk->belum_kawin }}</td>
                <td>{{ $p->sk->kawin }}</td>
                <td>{{ $p->sk->cerai_hidup }}</td>
                <td>{{ $p->sk->cerai_mati }}</td>
                    <?php
                }else{
                    ?>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <?php
                }
                } else if ($jenis == "pendidikan"){
                    ?>  
                    <?php
                    if($p->kelurahan != ""){
                        ?>
                    <td>{{ $p->pendidikan->belum_sekolah }}</td>
                    <td>{{ $p->pendidikan->belum_tamat_sd }}</td>
                    <td>{{ $p->pendidikan->tamat_sd }}</td>
                    <td>{{ $p->pendidikan->smp }}</td>
                    <td>{{ $p->pendidikan->sma }}</td>
                    <td>{{ $p->pendidikan->di_dii }}</td>
                    <td>{{ $p->pendidikan->diii }}</td>
                    <td>{{ $p->pendidikan->s1 }}</td>
                    <td>{{ $p->pendidikan->s2 }}</td>
                    <td>{{ $p->pendidikan->s3 }}</td>
                        <?php
                    }else{
                        ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <?php
                    }
                    } else if ($jenis == "pekerjaan"){
                        ?>  
                        <?php
                        if($p->kelurahan != ""){
                            ?>
                        <td>{{ $p->pekerjaan->tidak_bekerja }}</td>
                        <td>{{ $p->pekerjaan->aparat_pejabat_negara }}</td>
                        <td>{{ $p->pekerjaan->tenaga_pengajar }}</td>
                        <td>{{ $p->pekerjaan->wiraswasta }}</td>
                        <td>{{ $p->pekerjaan->pertanian }}</td>
                        <td>{{ $p->pekerjaan->nelayan }}</td>
                        <td>{{ $p->pekerjaan->bidang_keagamaan }}</td>
                        <td>{{ $p->pekerjaan->pelajar_dan_mahasiswa }}</td>
                        <td>{{ $p->pekerjaan->tenaga_kesehatan }}</td>
                        <td>{{ $p->pekerjaan->pensiunan }}</td>
                        <td>{{ $p->pekerjaan->lainnya }}</td>
                            
                            <?php
                        }else{
                            ?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>

                            <?php
                        }
                        } else if ($jenis == "umur"){
                            ?>  
                            <?php
                            if($p->kelurahan != ""){
                                ?>
                            <td>{{ $p->umur->u0_4 }}</td>
                            <td>{{ $p->umur->u5_9 }}</td>
                            <td>{{ $p->umur->u10_14 }}</td>
                            <td>{{ $p->umur->u15_19 }}</td>
                            <td>{{ $p->umur->u20_24 }}</td>
                            <td>{{ $p->umur->u25_29 }}</td>
                            <td>{{ $p->umur->u30_34 }}</td>
                            <td>{{ $p->umur->u35_39 }}</td>
                            <td>{{ $p->umur->u40_44 }}</td>
                            <td>{{ $p->umur->u45_49 }}</td>
                            <td>{{ $p->umur->u50_54 }}</td>
                            <td>{{ $p->umur->u55_59 }}</td>
                            <td>{{ $p->umur->u60_64 }}</td>
                            <td>{{ $p->umur->u65_69 }}</td>
                            <td>{{ $p->umur->u70_74 }}</td>
                            <td>{{ $p->umur->u75_above }}</td>
                            
                                
                                <?php
                            }else{
                                ?>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>

                                <?php
                            }
                            } else {
            
                            }
            ?>
            
			
			<td>
				<a class="btn btn-warning btn-sm" href="/penduduk/edit/{{ $p->id_lokasi }}"><img src="/images/edit.png" width="17" height="17" class="d-inline-block align-top" alt=""> Edit </a>
				<a class="btn btn-danger btn-sm" onclick="confirmDelete({{$p->id_lokasi}})"><img src="/images/trash.png" width="17" height="17" class="d-inline-block align-top" alt=""> Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>
    </font>
	<br/>
 
    
	{{ $penduduk->links() }}
	</div>
		</div>
	</div>
</body>
</html>