@extends('layout.main')

@section('title', 'Sapi Keluar')

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
            <h1 class="h3 mb-4 text-gray-800">Sapi Keluar</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" id="btn-modal-sapikeluar"><i class="fa fa-plus"></i> Keluarkan Sapi</button>
                </div>

                <div class="counter text-left ml-4">
                    <b>Total Sapi Keluar</b> : {{$counter}}
                </div>

                <div class="card-body table-responsive">
                    <div id="datatable-sapikeluar"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<!-- Add Sapi Keluar Modal-->
<div class="modal fade" id="SapiKeluarModal" tabindex="-1" role="dialog" aria-labelledby="AddSapiKeluarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddSapiKeluarModal">Form Sapi Keluar</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormSapiKeluar" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <!-- Kode Sapi -->
            <div class="form-group">
              <label for="kode">Kode Sapi <i style="color: red;">*</i></label>
              <select class="form-control" name="kode" id="kode">
                  @forelse($data_sapi as $data)
                  <option value="{{$data->kode}}">{{$data->kode}}</option>
                  @empty
                  <option value="">Belum ada data sapi</option>
                  @endforelse
              </select>
            </div>
            <!-- Harga -->
            <div class="form-group">
              <label for="harga">Harga</label>
              <input name="harga" type="number" class="form-control" id="harga" placeholder="Harga">
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status">Status <i style="color: red;">*</i></label>
              <input name="status" type="text" class="form-control" id="status" placeholder="Status">
            </div>
            <!-- Keterangan -->
            <div class="form-group">
              <label for="keterangan">Keterangan <i style="color: red;">*</i></label>
              <input name="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-sapikeluar">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Edit Sapi Keluar Modal-->
<div class="modal fade" id="EditSapiKeluarModal" tabindex="-1" role="dialog" aria-labelledby="EditSapiKeluarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Form Sapi Keluar</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormEditSapiKeluar" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id_sapi" id="id_sapi">
            <!-- Kode Sapi -->
            <div class="form-group">
              <label for="kode">Kode Sapi <i style="color: red;">*</i></label>
              <input type="text" name="edit_kode" id="edit_kode" class="form-control" readonly>
            </div>
            <!-- Harga -->
            <div class="form-group">
              <label for="edit_harga">Harga</label>
              <input name="edit_harga" type="number" class="form-control" id="edit_harga" placeholder="Harga">
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="edit_status">Status <i style="color: red;">*</i></label>
              <input name="edit_status" type="text" class="form-control" id="edit_status" placeholder="Status">
            </div>
            <!-- Keterangan -->
            <div class="form-group">
              <label for="edit_keterangan">Keterangan <i style="color: red;">*</i></label>
              <input name="edit_keterangan" type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-save-sapikeluar">Save</button>
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
