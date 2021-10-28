@extends('Auth.layout.app')

@section('title','Login Page')

@section('content')
  <section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
      <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
          
          <!-- Logo -->
          <!-- <a href="{{url('/')}}">
            <center><img src="{{asset('assets/img/logo/logo-horizontal.png')}}" width="50%" alt="Sapiku"></center>
          </a> -->
          <h1>Sapiku</h1>

          <!-- Form Login -->
          <form method="POST" action="{{ url('/postLogin') }}">
            {{csrf_field()}}
            <!-- Username -->
            <div class="form-group">
              <label for="username">Username</label>
              <input id="username" type="text" class="form-control" name="username" placeholder="Username" tabindex="1" required autofocus>
            </div>
            <!-- Password -->
            <div class="form-group">
              <div class="d-block">
                <label for="password" class="control-label">Password</label>
              </div>
              <div class="input-group" id="show_hide_password">
                <input name="password" type="password" minlength="8" class="form-control" tabindex="2" id="password" placeholder="Password" required="">
                <!-- Show Hide Password Component -->
                <a href=""><div class="input-group-addon eye">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div></a>
              </div>
              <div class="invalid-feedback">
                Harap Isi Password
              </div>
            </div>
            <div class="form-group text-right">
              <div class="row">
               
              <div class="col-4">
                <p><a href="" class="nounderline" data-toggle="modal" data-target="#modalKu">Lupa Password ?</a></p>
              </div>
              </div>
              
              <!-- Login Button -->
              <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                Masuk
              </button>
            </div>
          </form>
          <!-- Copyright -->
          <div class="text-center mt-5 text-small">
            Copyright &copy; Sapiku {{ date('Y') }}
          </div>
        </div>
      </div>
      <!-- Side Running Background -->
      <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('assets/img/cow.jpg') }}">
        <div class="absolute-bottom-left index-2">
          <div class="text-light p-5 pb-2">
            <div class="mb-5 pb-3">
              <h1 class="mb-2 display-4 brand-logo">Sapiku</h1>
            </div>
            Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/@masrozy">Mas Rozy</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('modal')
  <!-- Modal Owner-->
  <div class="modal fade" id="modalKu" tabindex="-1" role="dialog" aria-labelledby="modalKu" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"> 
        <div class="modal-header">
          <h5 class="modal-title" id="form">Yah Kasihan :(</h5>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Owner -->
@endpush
@push('javascript')
  <script src="{{ asset('assets/js/upload-images.js') }}"></script>
@endpush