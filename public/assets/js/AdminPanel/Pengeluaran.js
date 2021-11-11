$(document).ready(function() {

    //DATATABLE PENGELUARAN
    LoadTablePengeluaran();
    function LoadTablePengeluaran() {
        $('#datatable-pengeluaran').load('/pengeluaran/load/table-pengeluaran', function() {
            $('#table-pengeluaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/pengeluaran/load/data-pengeluaran',
                    type: 'get'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    }
                ]
            });
        });
    }

    //OPEN MODAL TAMBAH PENGELUARAN
    $("#btn-modal-pengeluaran").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-pengeluaran").css("display","");
        $(".btn-loading").css("display","none");
        $("#AddPengeluaranModal").modal("show");
    });

    //SUBMIT DATA PENGELUARAN
    $("body").on("submit","#FormPengeluaran", function(e){
        e.preventDefault()
        $(".btn-close").css("display","none")
        $(".btn-loading").css("display","")
        $(".btn-submit-pengeluaran").css("display","none")
        var data = $("#FormPengeluaran").serialize()

        $.ajax({
            type: "post",
            url: "/pengeluaran/add",
            data: data,
            success: function(response){

                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-pengeluaran").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-pengeluaran").css("display","")
                    $("#AddPengeluaranModal").modal("hide")
                    $("#FormPengeluaran").trigger("reset")
                    LoadTablePengeluaran()
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Pengeluaran',
                        timer: 1200,
                        showConfirmButton: false
                    });
                }

            },
            error: function(err){
                console.log(err)
            }
        });
    });

    // OPEN MODAL EDIT PENGELUARAN
    $("body").on("click",".btn-edit-pengeluaran",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-pengeluaran").css("display","");
        $(".btn-loading").css("display","none");
        $("#EditPengeluaranModal").modal("show");
        var id = $(this).attr("data-id");
        var jumlah = $(this).attr("data-jumlah");
        var tanggal = $(this).attr("data-tanggal");
        var keterangan = $(this).attr("data-keterangan");

        $("#id").val(id);
        $("#edit_jumlah").val(jumlah);
        $("#edit_tanggal").val(tanggal);
        $("#edit_keterangan").val(keterangan);
    });

    // SAVE EDIT PENGELUARAN
    $("body").on("submit","#FormEditPengeluaran", function(e){
        e.preventDefault()
        var id = $("#id").val();
        var data = $("#FormEditPengeluaran").serialize();
        var jumlah = $("#edit_jumlah").val();
        var tanggal = $("#edit_tanggal").val();
        var keterangan = $("#edit_keterangan").val();

        $(".btn-close").css("display","none");
        $(".btn-save-pengeluaran").css("display","none");
        $(".btn-loading").css("display","");

        $.ajax({
            type: "post",
            url: "/pengeluaran/update/"+id,
            data: data,
            success: function(response){
                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-save-pengeluaran").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    $(".btn-close").css("display","");
                    $(".btn-save-pengeluaran").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormEditPengeluaran").trigger("reset");
                    $("#EditPengeluaranModal").modal("hide");
                    LoadTablePengeluaran();
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Data Pengeluaran',
                        timer: 1200,
                        showConfirmButton: false
                    });
                }
            },
            error: function(err){
                console.log(err);
            }
        });

    });

    //DELETE PENGELUARAN
    $("body").on("click",".btn-delete-pengeluaran", function(e){
        e.preventDefault()
        var id = $(this).attr("data-id");

        Swal.fire({
            title: 'Hapus data pengeluaran ?',
            text: 'Anda tidak dapat mengurungkan aksi ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'get',
                    url: '/pengeluaran/delete/' + id,
                    success: function(response) {
                        Swal.fire('Deleted! data telah dihapus.', 'success');
                        LoadTablePengeluaran();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });

});