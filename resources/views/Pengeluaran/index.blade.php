@extends('layout.main')

@section('title', 'Pengeluaran')

@section('content')
<script type="text/javascript">
  document.getElementById('pengeluaran').classList.add('active');
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Data Pengeluaran</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary mr-2 mb-1" id="btn-modal-pengeluaran"><i class="fa fa-plus"></i> Tambah Pengeluaran</button>
                    <a href="{{ url('/pengeluaran/export') }}" class="btn btn-success mb-1"><i class="fa fa-download"></i> Export</a>
                </div>

                <div class="counter text-left ml-4">
                    <b>Total Pengeluaran</b> : {{$counter}}
                </div>
                
                <div class="card-body table-responsive">
                    <div id="datatable-pengeluaran"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<!-- Add Pengeluaran Modal-->
<div class="modal fade" id="AddPengeluaranModal" tabindex="-1" role="dialog" aria-labelledby="AddPengeluaranModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="PengeluaranTitle">Tambah Pengeluaran</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormPengeluaran" enctype="multipart/form-data" method="post">
            @csrf
            <!-- Jumlah -->
            <div class="form-group">
              <label for="jumlah">Jumlah Pengeluaran <i style="color: red;">*</i></label>
              <input name="jumlah" type="number" class="form-control" id="jumlah" placeholder="Jumlah Pengeluaran (Rp.)">
            </div>
            <!-- Tanggal -->
            <div class="form-group">
              <label for="tanggal">Tanggal <i style="color: red;">*</i></label>
              <input name="tanggal" type="date" class="form-control" id="tanggal">
            </div>
            <!-- Keterangan -->
            <div class="form-group">
              <label for="keterangan">Keterangan <i style="color: red;">*</i></label>
              <input name="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan Pengeluaran">
            </div>
            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-pengeluaran">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Edit Pengeluaran Modal-->
<div class="modal fade" id="EditPengeluaranModal" tabindex="-1" role="dialog" aria-labelledby="PengeluaranModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="PengeluaranModal">Edit Data Pengeluaran</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormEditPengeluaran" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id">

            <!-- Jumlah -->
            <div class="form-group">
              <label for="edit_jumlah">Jumlah Pengeluaran <i style="color: red;">*</i></label>
              <input name="edit_jumlah" type="number" class="form-control" id="edit_jumlah" placeholder="Jumlah Pengeluaran (Rp.)">
            </div>
            <!-- Tanggal -->
            <div class="form-group">
              <label for="edit_tanggal">Tanggal <i style="color: red;">*</i></label>
              <input name="edit_tanggal" type="date" class="form-control" id="edit_tanggal">
            </div>
            <!-- Keterangan -->
            <div class="form-group">
              <label for="edit_keterangan">Keterangan <i style="color: red;">*</i></label>
              <input name="edit_keterangan" type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan Pengeluaran">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-save-pengeluaran">Save</button>
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
    <script src="{{asset('assets/js/AdminPanel/Pengeluaran.js')}}"></script>
@endpush
