@extends('layout.main')

@section('title', 'Pengurus Sapi')

@section('content')
<script type="text/javascript">
  document.getElementById('pengurus').classList.add('active');
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Daftar Pengurus Sapi</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" id="btn-modal-pengurus"><i class="fa fa-plus"></i> Tambah Pengurus</button>
                </div>

                <div class="counter text-left ml-4">
                    <b>Total Pengurus</b> : {{$counter}}
                </div>
                
                <div class="card-body table-responsive">
                    <div id="datatable-pengurus"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<!-- Add Pengurus Modal-->
<div class="modal fade" id="PengurusModal" tabindex="-1" role="dialog" aria-labelledby="AddPengurusModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddPengurusModal">Tambah Pengurus</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormPengurus" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nama Lengkap <i style="color: red;">*</i></label>
              <input name="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap" required="">
            </div>
            <!-- Username -->
            <div class="form-group">
              <label for="username">Username <i style="color: red;">*</i></label>
              <input name="username" type="text" class="form-control" id="username" placeholder="Username" required="">
            </div>
            <!-- Password -->
            <div class="form-group">
              <label for="password">Default Password <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="password" type="password" class="form-control" id="password" minlength="8" placeholder="Password" required="">
                <a href="">
                    <div class="input-group-addon eye">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                </a>
              </div>
            </div>
            <!-- Phone -->
            <div class="form-group">
              <label for="phone_number">Nomor Telepon <i style="color: red;">*</i></label>
              <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" required="">
            </div>
            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-admin">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Edit Password Pengurus Modal-->
<div class="modal fade" id="EditPasswordModal" tabindex="-1" role="dialog" aria-labelledby="PasswordModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="PasswordModal">Ubah Password</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormEditPassword" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id_pengurus" id="id_pengurus">

            <!-- Password -->
            <div class="form-group">
              <label for="edit_password">Password Baru <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="edit_password" type="password" class="form-control" id="edit_password" minlength="8" placeholder="Password Baru" required="">
                <a href="">
                    <div class="input-group-addon eye">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                </a>
              </div>
            </div>

            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-save-password">Save</button>
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
    <script src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
    <script src="{{asset('assets/js/AdminPanel/Pengurus.js')}}"></script>
@endpush
