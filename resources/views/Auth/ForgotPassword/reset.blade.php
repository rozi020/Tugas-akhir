@extends('Auth.layout.app')

@section('title','Reset Password')

@section('content')
  <section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
      <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
          <a class="back-btn" href="{{url('/login')}}">
            <label>< Batal</label>
          </a>
          <!-- Judul Form -->
          <center><h1 class="logo">Reset Password</h1></center>
          
          <div class="alert alert-info alert-dismissible show fade">
		    <div class="alert-body">
		      <button class="close" data-dismiss="alert">
		        <span>&times;</span>
		      </button>
		      <p>Harap masukkan password baru anda dan jangan menggunakan password lama.</p>
		    </div>
		  </div>
          
          	<!-- Form Forgot Password -->
			<form class="user" method="POST" action="{{ route('password.update') }}">
				@csrf
			    <input type="hidden" name="token" value="{{ $token }}">
			    <div class="form-group">
			        <input id="email" type="hidden" class="form-control form-control-user" name="email" value="{{ $email ?? old('email') }}" placeholder="Masukkan Email">
			    </div>

			    <div class="form-group">
			        <label for="password">Password Baru</label>

			        <div class="input-group" id="show_hide_password">
			          <input id="password" type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password Baru" required autocomplete="new-password" minlength="8" autofocus>
			          <!-- Show Hide Password Component -->
			          <a href=""><div class="input-group-addon eye">
			            <i class="fa fa-eye-slash" aria-hidden="true"></i>
			          </div></a>
			          <!-- Show Hide Password Component -->
			        </div>
			    </div>

			    <div class="form-group">
			        <label for="password-confirm">Konfirmasi Password</label>

			        <div class="input-group" id="show_hide_password-2">
			          <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password" minlength="8" autofocus>
			          <!-- Show Hide Password Component -->
			            <a href=""><div class="input-group-addon eye">
			              <i class="fa fa-eye-slash" aria-hidden="true"></i>
			            </div></a>
			            <!-- Show Hide Password Component -->
		          	</div>
		        </div>

			  <button type="submit" class="btn btn-primary btn-user btn-block">
			    Reset Password
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