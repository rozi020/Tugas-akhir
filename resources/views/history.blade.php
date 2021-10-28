@extends('layout.main')

@section('title', 'Log History')

@section('content')
<script type="text/javascript">
  document.getElementById('history').classList.add('active');
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Log History Pengurus</h1>
            <!-- DataTables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <div class="counter">
                        <b>Total History</b> : {{$counter}}
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <div id="datatable-history"></div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
@endsection
@push('javascript')
    <script src="{{asset('assets/js/AdminPanel/History.js')}}"></script>
@endpush
