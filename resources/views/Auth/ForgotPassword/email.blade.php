@extends('Auth.layout.app')

@section('title','Lupa Password')

@section('content')
  <section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
      <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
          <a class="back-btn" href="{{url('/login')}}">
            <label>< Kembali</label>
          </a>
          <!-- Judul Form -->
          <center><h1 class="logo">Lupa Password</h1></center>
          
          <div class="alert alert-info alert-dismissible show fade">
		    <div class="alert-body">
		      <button class="close" data-dismiss="alert">
		        <span>&times;</span>
		      </button>
		      <p>Harap masukkan Email anda yang terdaftar, Kami akan mengirimkan anda sebuah Email untuk melakukan proses Verifikasi.</p>
		    </div>
		  </div>
          
          <!-- Form Forgot Password -->
          <form class="user" method="POST" action="{{ route('password.email') }}">
	          @csrf
	          <div class="form-group">
	            <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required autocomplete="email" autofocus>
	          </div>
	          <button type="submit" class="btn btn-primary btn-user btn-block">
	            Kirim Link Reset Password
	          </button>
	        </form>
          <!-- Copyright -->
          <div class="text-center mt-5 text-small">
            Copyright &copy; {{ date('Y') }}
          </div>
        </div>
      </div>
      <!-- Side Running Background -->
      <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('assets/img/banner/login-wp.jpg') }}">
        <div class="absolute-bottom-left index-2">
          <div class="text-light p-5 pb-2">
            <div class="mb-5 pb-3">
              <h1 class="mb-2 display-4 brand-logo">PangkasO</h1>
            </div>
            Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/@jeppemoenster">Jeppe Mønster</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection