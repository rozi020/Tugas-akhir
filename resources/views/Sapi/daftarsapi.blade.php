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
                 <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                    <th>Nomor</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Berat Badan</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
			                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="">Tambah</a>
                                        <a class="btn btn-warning btn-sm" href="">Edit</a>
                                        <a class="btn btn-danger btn-sm" href="">Hapus</a>
				                    </td>
			                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>
@endsection
