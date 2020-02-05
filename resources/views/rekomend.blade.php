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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    
     <script src="{{ asset('js/mapInput.js') }}"></script> 
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
        <a class="nav-link" href="/user">Pengguna Aplikasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Perekomendasian Usaha</a>
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
<br/>
<br/>
<?php 

if($rekomendasi == ""){
    ?>

    <?php
}else{
    ?>
<div class="m-5 ">
    <div class="card text-center">
  <div class="card-header">
    <div class="text-center">
    <h2>Hasil Rekomendasi</h2>
    <h6> Kecamatan {{$loc['kec']}},Kelurahan {{$loc['kel']}} </h6>
    </div>
    </div>
    <div class="card-body">
    <br/>
    <table class="table table-bordered table-hover table-striped ">
    <tr>
			<th>Peringkat</th>
			<th>Nama Alternatif</th>
			<th>Skor</th>
			<th>Rekomendasi Harga</th>
	</tr>
    @foreach($rekomendasi as $p)
    <tr>
			<td>{{ $p->peringkat }}</td>
			<td>{{ $p->nama_alternatif }}</td>
			<td>{{ $p->skor }}</td>
			<td>{{ $p->rharga }}</td>
    </tr>
    @endforeach
	</table>
    </div></div>
</div>
<div class="border-top border-dark mb-3"></div>

    <?php
}

?>
<div class="form-group text-center ml-5 mr-5">
    <label for="address_address" ><h2>Cari Lokasi Usaha</h2></label>
    
    
    <input type="text" id="address-input" name="address_address" class="form-control map-input" placeholder="Masukan Alamat, Tempat, Atau Kelurahan">
    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
</div>
<div id="address-map-container" style="width:100%;height:400px;" >
    <div style="width: 100%; height: 100%" id="address-map"></div>
</div>
<br/>
<div class="text-center">
<a class="btn btn-success btn-sm" href="/rekomend/result/"> Cari Rekomendasi </a>
<script>
// document.cookie = "lat="+sessionStorage.getItem('lat')+";path=/";
// document.cookie = "lng="+sessionStorage.getItem('lng')+";path=/";

var cookie = document.cookie;
// alert(cookie);
var array = cookie.split(";");
if(array[0].substr(0, 3) == "lat"){
    var loclat = array[0].split("=");
    var lat = loclat[1];  
    var loclng = array[1].split("=");
    var lng = loclng[1];
}else{
    var dev = array.length;
    var loclat = array[dev-2].split("=");
    var lat = loclat[1];  
    var loclng = array[dev-1].split("=");
    var lng = loclng[1];
}


sessionStorage.setItem('lat', lat);
sessionStorage.setItem('lng', lng);
// alert(parseFloat(lat));
if(!parseFloat(lat)){
    document.cookie = "lat=-6.914744;path=/";
    document.cookie = "lng=107.609810;path=/";
    sessionStorage.setItem('lat', -6.914744);
    sessionStorage.setItem('lng', 107.609810);
    // alert("zzzkkk");
}else{
    document.cookie = "lat="+sessionStorage.getItem('lat')+";path=/";
    document.cookie = "lng="+sessionStorage.getItem('lng')+";path=/";
}

// alert("sent"+lat+" "+lng);
</script>
</div>
<br/>



</body>
</html>

    
