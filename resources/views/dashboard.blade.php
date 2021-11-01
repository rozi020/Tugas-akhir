@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<script type="text/javascript">
  document.getElementById('dashboard').classList.add('active');
</script>
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> 
    </div>

    <!-- Content Row -->
    <div class="row">
        <marquee direction="up" scrollamount="50" behavior="slide">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
              <a href="#" class="nounderline">
              <div class="card card-primary">
                <div class="card-header">
                  <i id="micon2" class="fa fa-users" aria-hidden="true"></i>
                  <div class="ml-auto">
                    <h4>Total Pengurus</h4>
                    <h3 align="center">{{ $pengurus }}</h3>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <a href="{{url('/sapi')}}" class="nounderline">
              <div class="card card-primary">
                <div class="card-header">
                  <i id="micon2" class="fa fa-clipboard-list" aria-hidden="true"></i>
                  <div class="ml-auto">
                    <h4>Total Sapi</h4>
                    <h3 align="center">{{ $sapi }}</h3>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <a href="{{url('/sapi-keluar')}}" class="nounderline">
              <div class="card card-primary">
                <div class="card-header">
                  <i id="micon2" class="fa fa-sign-out-alt" aria-hidden="true"></i>
                  <div class="ml-auto">
                    <h4>Total Sapi Keluar</h4>
                    <h3 align="center">{{ $sapiKeluar }}</h3>
                  </div>
                </div>
              </div>
              </a>
            </div>
        </div>
        </marquee>
        <!-- Collapse -->
        <marquee direction="up" scrollamount="50" behavior="slide">
        <a class="nounderline" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseAdd">
          <div class="card card-primary">
            <div class="card-header">
              <i id="micon2" class="fa fa-tasks" aria-hidden="true"></i>
              <div class="ml-auto table-responsive">
                <h4>Aktivitas Saya</h4>
                <div class="collapse" id="collapseAdd">
                  <div class="card card-body">
                    <table class="table table-borderless table-hover">
                      <thead>
                        <tr align="center">
                          <th width="5%" scope="col"><center>#</center></th>
                          <th scope="col">Aksi</th>
                          <th scope="col" colspan="2">Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($activity as $no => $a)
                        <tr>
                          <td align="center">{{ $no +1 }}</td>
                          <td align="center">{{ $a->aksi }}</td>
                          <td>{{$a->keterangan}}</td>
                          <td align="center">{{ $a->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="4"><center>Anda belum melakukan aktivitas apapun</center></td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
        </marquee>
        <!-- Collapse -->
        <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax">
            <div class="hero-inner">
              <h2>Selamat datang kembali, {{auth()->user()->name}}!</h2>
              <p class="lead">Mari rawat data pemerahan sapi kita dengan baik dan rutin 😊</p>
              <p class="lead">Dan rawat sapi kita dengan penuh kasih sayang dan rasa tanggung jawab yang maksimal, untuk kualitas susu perah terbaik 💕</p>
              <div class="mt-4">
                <a href="{{url('/hasil-perah')}}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-tint"></i> Perah Sapi Kita</a>
              </div>
            </div>
          </div>
        </div>

    </div>

@endsection
@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
@endpush
@push('javascript')
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <!-- Toaster -->
  <script>
    @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
    @elseif(Session::has('bye'))
      toastr.error("{{ Session::get('bye') }}");
    @endif
  </script>

  <!-- Toastr Validation -->
  <script>
    @if($errors->any())
      @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
      @endforeach
    @endif
  </script>
@endpush