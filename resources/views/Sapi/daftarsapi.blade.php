@extends('layout.main')

@section('title', 'Daftar Sapi')

@section('content')
<script type="text/javascript">
  document.getElementById('sapi').classList.add('active');
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Daftar Sapi</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" id="btn-modal-daftarsapi"><i class="fa fa-plus"></i> Tambah Sapi</button>
                </div>

                <div class="counter text-left ml-4">
                    <b>Total Sapi</b> : {{$counter}}
                </div>

                <div class="card-body table-responsive">
                    <div id="datatable-daftarsapi"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<!-- Add Sapi Modal-->
<div class="modal fade" id="DaftarSapiModal" tabindex="-1" role="dialog" aria-labelledby="AddDaftarSapiModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddDaftarSapiModal">Tambah Sapi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormDaftarSapi" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <!-- Kode Sapi -->
            <div class="form-group">
              <label for="kode">Kode Sapi <i style="color: red;">*</i></label>
              <input name="kode" type="text" class="form-control" id="kode" placeholder="Kode Sapi" required="">
            </div>
            <!-- Username -->
            <div class="form-group">
              <label for="umur">Umur <i style="color: red;">*</i></label>
              <input name="umur" type="number" class="form-control" id="umur" placeholder="Umur" required="">
            </div>
            <!-- Berat -->
            <div class="form-group">
              <label for="berat">Berat <i style="color: red;">*</i></label>
              <input name="berat" type="number" class="form-control" id="berat" placeholder="Berat" required="">
            </div>
            <!-- Jenis Sapi -->
            <div class="form-group">
              <label for="jenis">Jenis Sapi <i style="color: red;">*</i></label>
              <input name="jenis" type="text" class="form-control" id="jenis" placeholder="Jenis Sapi" required="">
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status">Status <i style="color: red;">*</i></label>
              <input name="status" type="text" class="form-control" id="status" placeholder="Status" required="">
            </div>
            
            <!-- Upload image input-->
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input id="upload" type="file" name="foto" onchange="readURL(this);" class="form-control">
                <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload Foto disini ...</label>
                <div class="input-group-append">
                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fas fa-cloud-upload-alt mr-2 text-muted"></i> <small style="font-size: 12px;" class="text-bold">Pilih Foto</small></label>
                </div>
            </div>

            <!-- Uploaded image area-->
            <p class="font-italic text-center">Gambar preview akan ditampilkan dibawah</p>
            <div class="image-area mt-4">
                <img id="imageResult" src="{{asset('assets/img/no-image.jpg')}}" alt="" width="300px" height="300px" class="img-fluid rounded shadow-sm mx-auto d-block">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-daftarsapi">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
    <script src="{{ asset('assets/js/upload-images.js') }}"></script>
    <script src="{{asset('assets/js/AdminPanel/Sapi.js')}}"></script>
@endpush
