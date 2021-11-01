@extends('layout.main')

@section('title', 'Hasil Perah')

@section('content')
<script type="text/javascript">
  document.getElementById('hasilPerah').classList.add('active');
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Data Hasil Perah</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" id="btn-modal-hasilperah"><i class="fa fa-plus"></i> Tambah Hasil Perahan</button>
                </div>

                <div class="counter text-left ml-4">
                    <b>Total Pemerahan</b> : {{$counter}}
                </div>

                <div class="card-body table-responsive">
                    <div id="datatable-hasilperah"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<!-- Add Hasil Perah Modal-->
<div class="modal fade" id="HasilPerahModal" tabindex="-1" role="dialog" aria-labelledby="AddHasilPerahModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddHasilPerahModal">Form Pemerahan Sapi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormHasilPerah" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <!-- Kode Sapi -->
            <div class="form-group">
                <label for="id_sapi">Kode Sapi <i style="color: red;">*</i></label>
                <select class="form-control" name="id_sapi" id="id_sapi" required>
                    @forelse($data_sapi as $data)
                    <option value="{{$data->id}}">{{$data->kode}}</option>
                    @empty
                    <option value="">Belum ada data sapi</option>
                    @endforelse
                </select>
            </div>
            <!-- Jumlah -->
            <div class="form-group">
              <label for="jumlah_perah">Jumlah Perah <i style="color: red;">*</i></label>
              <input name="jumlah_perah" type="number" class="form-control" id="jumlah_perah" placeholder="(Liter)" required="">
            </div>
            <!-- Tanggal -->
            <div class="form-group">
              <label for="tanggal_perah">Tanggal Perah <i style="color: red;">*</i></label>
              <input name="tanggal_perah" type="date" class="form-control" id="tanggal_perah" placeholder="Tanggal Perah" required="">
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-hasilperah">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Edit Hasil Perah Modal-->
<div class="modal fade" id="EditHasilPerahModal" tabindex="-1" role="dialog" aria-labelledby="EditHasilPerahModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Hasil Perah</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormEditHasilPerah" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id_perah" id="id_perah">
            <!-- Kode Sapi -->
            <div class="form-group">
                <select class="form-control" name="edit_id_sapi" id="edit_id_sapi" required>
                    @foreach($data_sapi as $data)
                    <option value="{{$data->id}}">{{$data->kode}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Jumlah -->
            <div class="form-group">
              <label for="edit_jumlah">Jumlah Perah <i style="color: red;">*</i></label>
              <input name="edit_jumlah" type="number" class="form-control" id="edit_jumlah" placeholder="(Liter)" required="">
            </div>
            <!-- Tanggal -->
            <div class="form-group">
              <label for="edit_tanggal">Tanggal Perah <i style="color: red;">*</i></label>
              <input name="edit_tanggal" type="date" class="form-control" id="edit_tanggal" placeholder="Tanggal Perah" required="">
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
