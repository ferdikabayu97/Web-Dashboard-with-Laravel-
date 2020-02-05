<!DOCTYPE html>
<html>
<head>
    <title>Rekusaha</title>
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
          Situs Untuk Managing Penggunaan Aplikasi Rek Usaha
    </span>
  </div>
</nav>
@include('sweet::alert')
<br/>
<br/>
<div class="text-center mt-5">
<img src="/images/logobig.png" width="150" height="150" class="d-inline-block align-top" alt="">
</div>
<div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
 
	
 
 <form action="/login" method="post">
		{{ csrf_field() }}
        
        <div class="form-group">
			ID Admin <br/> <input class="form-control {{Request::cookie('username') === null ? (Request::cookie('username') === old('id') ? (old('id') == null ? '' : 'is-invalid') : (old('id') == null ? '' : 'is-invalid')) : 'is-valid'}}" type="text" name="id" value="{{(old('id') == null ? Request::cookie('username') : old('id'))}}" required="required"> <br/>
		</div>
        <div class="form-group">
        	Password <br/><input class="form-control {{Request::cookie('password') === null ? (Request::cookie('password') === old('pass') ? (old('pass') == null ? '' : 'is-invalid') : (old('pass') == null ? '' : 'is-invalid')) : 'is-valid'}}" type="password" value="{{(old('pass') == null ? Request::cookie('password') : old('pass'))}}" name="pass" required="required"> 
            <div class="form-check text-right mr-3 mt-3">
    <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me" value="true">
    <label class="form-check-label" for="exampleCheck1"> Ingat Saya?</label>
  </div>
        </div>
        
        <div class="text-center">
        
		<input class="btn btn-primary" type="submit" value="Masuk">
        </div>

	    </form>
        
    </div>
                    </div>
                </div>
            </div>
        </div>
 
</body>
</html>