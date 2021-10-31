@extends('layout.main')

@section('title', 'Profile')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <center>
            <div class="section-body">
                <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                    <div class="card-body text-center">
                      <div class="form-group">
                        Bergabung sejak {{ auth()->user()->created_at->diffForHumans() }}
                      </div>
                      <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!-- Foto -->
                        <div class="avatar-upload">
                          <div class="avatar-edit">
                              <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                              <label for="imageUpload"></label>
                          </div>
                          @if(auth()->user()->avatar != NULL)
                            <a href="{{ asset('assets/images/users/avatar/'.auth()->user()->avatar) }}" data-fancybox data-caption="Foto profil {{auth()->user()->name}}">
                          @else
                            <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" data-fancybox data-caption="Foto Profil dummy, kamu belum mengunggah foto profil">
                          @endif
                            <div class="avatar-preview">
                              @if(auth()->user()->avatar != NULL)
                                <div id="imagePreview" style="background-image: url('{{url('assets/img/avatar/'.auth()->user()->avatar)}}');"></div>
                              @else
                                <div id="imagePreview" style="background-image: url('{{url('assets/img/avatar-stock.jpg')}}');"></div>
                              @endif
                            </div>
                          </a>
                        </div>
                        
                        <!-- Nama -->
                        <div class="form-group profile-input">
                          <label for="inputNama">Nama</label>
                          <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama" value="{{auth()->user()->name}}" required="">
                        </div>
                        <!-- Email -->
                        <div class="form-group profile-input">
                            <label for="inputUsername">Username</label>
                            <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Username" value="{{auth()->user()->username}}" required="">
                        </div>
                        <!-- Gender -->
                        <div class="form-check ">
                          <label for="gender">Jenis Kelamin</label><br>
                          @if(auth()->user()->gender == 'male')
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male" checked="">
                            <label class="form-check-label" for="male">Laki - Laki</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female">
                            <label class="form-check-label" for="female">Perempuan</label>
                          </div>
                          @elseif(auth()->user()->gender == 'female')
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male">
                            <label class="form-check-label" for="male">Laki - Laki</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female" checked="">
                            <label class="form-check-label" for="female">Perempuan</label>
                          </div>
                          @else
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male" checked="">
                            <label class="form-check-label" for="male">Laki - Laki</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female">
                            <label class="form-check-label" for="female">Perempuan</label>
                          </div>
                          @endif
                        </div>
                        <!-- Phone -->
                        <div class="form-group">
                          <label for="phone_number">Nomor Telepon</label>
                          <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" value="{{auth()->user()->phone_number}}" required="">
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                          <label for="inputAddress">Alamat</label>
                          <textarea name="address" id="inputAddress" class="form-control">{{auth()->user()->address}}</textarea>
                        </div>
                        
                        <br>
                        <div class="form-group text-center">
                          <a class="nounderline" href="{{ redirect()->back()->getTargetUrl() }}">
                            <button type="button" class="btn btn-danger col-md-3 col-lg-3">BATAL</button>
                          </a>
                          <button type="submit" class="btn btn-primary col-md-3 col-lg-3">SIMPAN</button>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>  
            </div>
            </center>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>
@endsection
@push('stylesheet')
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endpush
@push('javascript')
    <script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imageUpload").change(function() {
        readURL(this);
      });
    </script>
@endpush
