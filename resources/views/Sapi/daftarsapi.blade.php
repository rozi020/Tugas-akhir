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
              <input name="kode" type="text" class="form-control" id="kode" placeholder="Kode Sapi">
            </div>
            <!-- Username -->
            <div class="form-group">
              <label for="umur">Umur <i style="color: red;">*</i></label>
              <input name="umur" type="number" class="form-control" id="umur" placeholder="Umur">
            </div>
            <!-- Berat -->
            <div class="form-group">
              <label for="berat">Berat <i style="color: red;">*</i></label>
              <input name="berat" type="number" class="form-control" id="berat" placeholder="Berat">
            </div>
            <!-- Jenis Sapi -->
            <div class="form-group">
              <label for="jenis">Jenis Sapi <i style="color: red;">*</i></label>
              <input name="jenis" type="text" class="form-control" id="jenis" placeholder="Jenis Sapi">
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status">Status <i style="color: red;">*</i></label>
              <input name="status" type="text" class="form-control" id="status" placeholder="Status">
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

<!-- Edit Daftar Sapi Modal-->
<div class="modal fade" id="EditDaftarSapiModal" tabindex="-1" role="dialog" aria-labelledby="EditDaftarSapiModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Form Data Sapi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormEditDaftarSapi" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id_sapi" id="id_sapi">
            <!-- Kode Sapi -->
            <div class="form-group">
              <label for="kode">Kode Sapi <i style="color: red;">*</i></label>
              <input type="text" name="edit_kode" id="edit_kode" class="form-control" readonly placeholder="Kode">
            </div>
            <!-- Umur -->
            <div class="form-group">
              <label for="edit_umur">Umur <i style="color: red;">*</i></label>
              <input name="edit_umur" type="number" class="form-control" id="edit_umur" placeholder="Umur">
            </div>
            <!-- Berat -->
            <div class="form-group">
              <label for="edit_berat">Berat <i style="color: red;">*</i></label>
              <input name="edit_berat" type="number" class="form-control" id="edit_berat" placeholder="Berat">
            </div>
            <!-- Jenis -->
            <div class="form-group">
              <label for="edit_jenis">Jenis <i style="color: red;">*</i></label>
              <input name="edit_jenis" type="text" class="form-control" id="edit_jenis" placeholder="Jenis">
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="edit_status">Status <i style="color: red;">*</i></label>
              <input name="edit_status" type="text" class="form-control" id="edit_status" placeholder="Status">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-save-daftarsapi">Save</button>
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
    <script src="{{asset('assets/js/AdminPanel/Sapi.js')}}"></script>
@endpush
