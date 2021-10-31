$(document).ready(function() {

    //DATATABLE DAFTAR SAPI
	LoadTableDaftarSapi();
	function LoadTableDaftarSapi() {
		$('#datatable-daftarsapi').load('/daftar-sapi/load/table-daftarsapi', function() {
			$('#table-daftarsapi').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/daftar-sapi/load/data-daftarsapi',
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
						data: 'kode',
						name: 'kode',
                        className: 'text-center'
					},
                    {
                        data: 'umur',
                        name: 'umur',
                        className: 'text-center'
                    },
                    {
                        data: 'berat',
                        name: 'berat',
                        className: 'text-center'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
					{
						data: 'updated_at',
						name: 'updated_at',
                        className: 'text-center'
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

    //OPEN MODAL TAMBAH SAPI
    $("#btn-modal-daftarsapi").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-daftarsapi").css("display","");
        $(".btn-loading").css("display","none");
        $("#DaftarSapiModal").modal("show");
    });

    //SUBMIT SAPI
    $("body").on("submit","#FormDaftarSapi", function(e){
        e.preventDefault()
        $(".btn-submit-daftarsapi").css("display","none");
        $(".btn-loading").css("display","");
        $(".btn-close").css("display","none");
        var data = $("#FormDaftarSapi").serialize();
        var kode = $("#kode").val();
        var umur = $("#umur").val();
        var berat = $("#berat").val();
        var jenis = $("#jenis").val();
        var status = $("#status").val();

        if(kode != '' && umur != '' && berat != '' && jenis != '' && status != ''){
            $.ajax({
                type: "post",
                url: "/daftar-sapi/add",
                data: data,
                success: function(response){
                    LoadTableDaftarSapi();
                    $("#DaftarSapiModal").modal("hide");
                    $("#FormDaftarSapi").trigger("reset");
                    $(".btn-submit-daftarsapi").css("display","");
                    $(".btn-loading").css("display","none");
                    $(".btn-close").css("display","");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Sapi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-submit-daftarsapi").css("display","");
            $(".btn-loading").css("display","none");
            $(".btn-close").css("display","");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    // OPEN MODAL EDIT SAPI
    $("body").on("click",".btn-edit-daftarsapi",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-daftarsapi").css("display","");
        $(".btn-loading").css("display","none");
        $("#EditDaftarSapiModal").modal("show");
        var id = $(this).attr("data-id");
        var kode = $(this).attr("data-kode");
        var umur = $(this).attr("data-umur");
        var berat = $(this).attr("data-berat");
        var jenis = $(this).attr("data-jenis");
        var status = $(this).attr("data-status");

        $("#id_sapi").val(id);
        $("#edit_kode").val(kode);
        $("#edit_umur").val(umur);
        $("#edit_berat").val(berat);
        $("#edit_jenis").val(jenis);
        $("#edit_status").val(status);
    })

    // SAVE EDIT SAPI
    $("body").on("submit","#FormEditDaftarSapi", function(e){
        e.preventDefault()
        var id = $("#id_sapi").val();
        var data = $("#FormEditDaftarSapi").serialize();
        var kode = $("#edit_kode").val();
        var umur = $("#edit_umur").val();
        var berat = $("#edit_berat").val();
        var jenis = $("#edit_jenis").val();
        var status = $("#edit_status").val();

        $(".btn-close").css("display","none");
        $(".btn-save-daftarsapi").css("display","none");
        $(".btn-loading").css("display","");

        if(kode != '' && umur != '' && berat != '' && jenis != '' && status != ''){
            $.ajax({
                type: "post",
                url: "/daftar-sapi/update/"+id,
                data: data,
                success: function(response){
                    LoadTableDaftarSapi();
                    $(".btn-close").css("display","");
                    $(".btn-save-daftarsapi").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormEditDaftarSapi").trigger("reset");
                    $("#EditDaftarSapiModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Data Sapi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-close").css("display","");
            $(".btn-save-daftarsapi").css("display","");
            $(".btn-loading").css("display","none");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    //DELETE SAPI
    $("body").on("click",".btn-delete-daftarsapi", function(e){
        e.preventDefault()
        var id = $(this).attr("data-id");
        var kode = $(this).attr("data-kode");

        Swal.fire({
            title: 'Hapus data sapi dengan kode : ' + kode + '?',
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
                    url: '/daftar-sapi/delete/' + id,
                    success: function(response) {
                        Swal.fire('Deleted!', kode + ' telah dihapus.', 'success');
                        LoadTableDaftarSapi();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });

    //DATATABLE SAPI KELUAR
    LoadTableSapiKeluar();
    function LoadTableSapiKeluar() {
        $('#datatable-sapikeluar').load('/sapi-keluar/load/table-sapikeluar', function() {
            $('#table-sapikeluar').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/sapi-keluar/load/data-sapikeluar',
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
                        data: 'kode',
                        name: 'kode',
                        className: 'text-center'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
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

    //OPEN MODAL KELUARKAN SAPI
    $("#btn-modal-sapikeluar").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-sapikeluar").css("display","");
        $(".btn-loading").css("display","none");
        $("#SapiKeluarModal").modal("show");
    });

    //SUBMIT SAPI KELUAR
    $("body").on("submit","#FormSapiKeluar", function(e){
        e.preventDefault()
        $(".btn-submit-sapikeluar").css("display","none");
        $(".btn-loading").css("display","");
        $(".btn-close").css("display","none");
        var data = $("#FormSapiKeluar").serialize();
        var kode = $("#kode").val();
        var status = $("#status").val();
        var keterangan = $("#jenis").val();

        if(kode != '' && status != '' && keterangan != ''){
            $.ajax({
                type: "post",
                url: "/sapi-keluar/add",
                data: data,
                success: function(response){
                    LoadTableSapiKeluar();
                    $("#SapiKeluarModal").modal("hide");
                    $("#FormSapiKeluar").trigger("reset");
                    $(".btn-submit-sapikeluar").css("display","");
                    $(".btn-loading").css("display","none");
                    $(".btn-close").css("display","");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Mengeluarkan Sapi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-submit-sapikeluar").css("display","");
            $(".btn-loading").css("display","none");
            $(".btn-close").css("display","");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    // OPEN MODAL EDIT SAPI KELUAR
    $("body").on("click",".btn-edit-sapikeluar",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-sapikeluar").css("display","");
        $(".btn-loading").css("display","none");
        $("#EditSapiKeluarModal").modal("show");
        var id = $(this).attr("data-id");
        var kode = $(this).attr("data-kode");
        var harga = $(this).attr("data-harga");
        var status = $(this).attr("data-status");
        var keterangan = $(this).attr("data-keterangan");

        $("#id_sapi").val(id);
        $("#edit_kode").val(kode);
        $("#edit_harga").val(harga);
        $("#edit_status").val(status);
        $("#edit_keterangan").val(keterangan);
    })

    // SAVE EDIT SAPI KELUAR
    $("body").on("submit","#FormEditSapiKeluar", function(e){
        e.preventDefault()
        var id = $("#id_sapi").val();
        var data = $("#FormEditSapiKeluar").serialize();
        var harga = $("#edit_harga").val();
        var status = $("#edit_status").val();
        var keterangan = $("#edit_keterangan").val();

        $(".btn-close").css("display","none");
        $(".btn-save-sapikeluar").css("display","none");
        $(".btn-loading").css("display","");

        if(status != '' && keterangan != ''){
            $.ajax({
                type: "post",
                url: "/sapi-keluar/update/"+id,
                data: data,
                success: function(response){
                    LoadTableSapiKeluar();
                    $(".btn-close").css("display","");
                    $(".btn-save-sapikeluar").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormSapiKeluar").trigger("reset");
                    $("#EditSapiKeluarModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Data Sapi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-close").css("display","");
            $(".btn-save-sapikeluar").css("display","");
            $(".btn-loading").css("display","none");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });


    //DATATABLE HASIL PERAH
    LoadTableHasilPerah();
    function LoadTableHasilPerah() {
        $('#datatable-hasilperah').load('/hasil-perah/load/table-hasilperah', function() {
            $('#table-hasilperah').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/hasil-perah/load/data-hasilperah',
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
                        data: 'kode_sapi',
                        name: 'kode_sapi',
                        className: 'text-center'
                    },
                    {
                        data: 'jumlah_perah',
                        name: 'jumlah_perah',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_perah',
                        name: 'tanggal_perah',
                        className: 'text-center'
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

    //OPEN MODAL TAMBAH HASIL PERAH
    $("#btn-modal-hasilperah").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-hasilperah").css("display","");
        $(".btn-loading").css("display","none");
        $("#HasilPerahModal").modal("show");
    });

    //SUBMIT SAPI
    $("body").on("submit","#FormHasilPerah", function(e){
        e.preventDefault()
        $(".btn-submit-hasilperah").css("display","none");
        $(".btn-loading").css("display","");
        $(".btn-close").css("display","none");
        var data = $("#FormHasilPerah").serialize();
        var jumlah = $("#jumlah_perah").val();
        var tanggal = $("#tanggal_perah").val();

        if(jumlah != '' && tanggal != ''){
            $.ajax({
                type: "post",
                url: "/hasil-perah/add",
                data: data,
                success: function(response){
                    LoadTableHasilPerah();
                    $("#HasilPerahModal").modal("hide");
                    $("#FormHasilPerah").trigger("reset");
                    $(".btn-submit-hasilperah").css("display","");
                    $(".btn-loading").css("display","none");
                    $(".btn-close").css("display","");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Data Perah Sapi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-submit-hasilperah").css("display","");
            $(".btn-loading").css("display","none");
            $(".btn-close").css("display","");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    // OPEN MODAL EDIT SAPI
    $("body").on("click",".btn-edit-hasilperah",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-hasilperah").css("display","");
        $(".btn-loading").css("display","none");
        $("#EditHasilPerahModal").modal("show");
        var id = $(this).attr("data-id");
        var ids = $(this).attr("data-ids");
        var jumlah = $(this).attr("data-jumlah");
        var tanggal = $(this).attr("data-tanggal");

        $("#id_perah").val(id);
        $("#edit_id_sapi").val(ids);
        $("#edit_jumlah").val(jumlah);
        $("#edit_tanggal").val(tanggal);
    })

    // SAVE EDIT SAPI
    $("body").on("submit","#FormEditHasilPerah", function(e){
        e.preventDefault()
        var id = $("#id_perah").val();
        var data = $("#FormEditHasilPerah").serialize();
        var ids = $("#edit_id_sapi").val();
        var jumlah = $("#edit_jumlah").val();
        var tanggal = $("#edit_tanggal").val();

        $(".btn-close").css("display","none");
        $(".btn-save-hasilperah").css("display","none");
        $(".btn-loading").css("display","");

        if(jumlah != '' && tanggal != ''){
            $.ajax({
                type: "post",
                url: "/hasil-perah/update/"+id,
                data: data,
                success: function(response){
                    LoadTableHasilPerah();
                    $(".btn-close").css("display","");
                    $(".btn-save-hasilperah").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormEditHasilPerah").trigger("reset");
                    $("#EditHasilPerahModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Data Hasi Pemerahan',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-close").css("display","");
            $(".btn-save-hasilperah").css("display","");
            $(".btn-loading").css("display","none");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    //DELETE HASIL PERAH
    $("body").on("click",".btn-delete-hasilperah", function(e){
        e.preventDefault()
        var id = $(this).attr("data-id");
        var kode = $(this).attr("data-kode");

        Swal.fire({
            title: 'Hapus data hasil perah pada sapi dengan kode : ' + kode + '?',
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
                    url: '/hasil-perah/delete/' + id,
                    success: function(response) {
                        Swal.fire('Deleted!', kode + ' telah dihapus.', 'success');
                        LoadTableHasilPerah();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });
    
});