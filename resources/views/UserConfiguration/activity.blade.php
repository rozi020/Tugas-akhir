@extends('layout.main')

@section('title', 'My Activity')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="section-body mt-4 mb-4">
                <h2 class="section-title">My Activity History</h2>
                <div class="row">
                  <div class="col-12">
                    <div class="activities">
                        <!-- Activity -->
                    @forelse($activity as $history)
                      <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                        @switch($history->aksi)
                            @case('Login')
                            <i class="fas fa-sign-in-alt"></i>
                                @break
                            @case('Tambah')
                            <i class="fas fa-plus"></i>
                                @break
                            @case('Edit')
                            <i class="fas fa-pencil-alt"></i>
                                @break
                            @case('Hapus')
                            <i class="fas fa-trash-alt"></i>
                                @break
                        @endswitch
                        </div>
                        <div class="activity-detail">
                          <div class="mb-2">
                            <span class="text-job text-primary">{{$history->created_at->diffForHumans()}}</span>
                            <span class="bullet"></span>
                            <span class="text-job">{{$history->aksi}}</span>
                            <div class="float-right dropdown">
                              <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                              <div class="dropdown-menu">
                                <div class="dropdown-title">Detail</div>
                                <div class="dropdown-title">Aksi : {{$history->aksi}}</div>
                                <div class="dropdown-title">{{$history->created_at}}</div>
                              </div>
                            </div>
                          </div>
                          <p>{{$history->keterangan}}</p>
                        </div>
                      </div>
                    @empty
                    @endforelse
                        <!-- End of Activity -->
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>
@endsection
@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
@endpush
