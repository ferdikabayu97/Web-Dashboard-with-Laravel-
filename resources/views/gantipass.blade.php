<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password - Rekusaha</title>
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
<div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
 
	<form action="/storepass" method="post">
        {{ csrf_field() }}
	<br/>
        <div class="col">
                
            <div class="row m-3">
                <div class="col">
                <div class="col m-1">
                        Password Lama <br/><input class="form-control" type="password" name="oldpass" required="required" value = "{{ old('oldpass') }}"> <br/>
                    </div>
                    <br/>
                    <div class="col m-1">
                    Password Baru <br/><input class="form-control" type="password" name="newpass" required="required" value = "{{ old('newpass') }}"> <br/>
                    </div>
                    <div class="col m-1">
                    Konfirmasi Password <br/><input class="form-control" type="password" name="confpass" required="required" value = "{{ old('confpass') }}"> <br/>
                    </div>
		        </div>
		    </div>

            
        </div>
        <div class="text-center">
		<input class="btn btn-primary" type="submit" value="Ganti Password">
        </div>
	</form>
		
</body>
</html>