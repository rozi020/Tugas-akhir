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
                        data: 'foto',
                        name: 'foto',
                        "render": function(data, type, row) {
                            return '<img src="assets/img/sapi/'+ data + ' " style="height:100px;width:100px;border-radius:15px;"/>';
                        },
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
        var upload = $("#upload").val();

        if(kode != '' && umur != '' && berat != '' && jenis != '' && status != '' && upload != ''){
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

    })

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
    })

    //OPEN MODAL EDIT ROLES
    $("body").on("click",".btn-edit-roles",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-roles").css("display","");
        $(".btn-loading").css("display","none");
        $("#editRolesModal").modal("show");
        var id = $(this).attr("data-id");
        var role_name = $(this).attr("data-role_name");

        $("#id-roles").val(id);
        $("#edit_role_name").val(role_name);
    })

    //SAVE EDIT ROLES
    // $("body").on("submit","#FormEditRoles", function(e){
    //     e.preventDefault()
    //     var id = $("#id-roles").val();
    //     var data = $("#FormEditRoles").serialize();
    //     var role_name = $("#edit_role_name").val();

    //     $(".btn-close").css("display","none");
    //     $(".btn-save-roles").css("display","none");
    //     $(".btn-loading").css("display","");

    //     if(role_name != ''){
    //         $.ajax({
    //             type: "post",
    //             url: "/admin-panel/roles/update/"+id,
    //             data: data,
    //             success: function(response){
    //                 LoadTableRoles();
    //                 $(".btn-close").css("display","");
    //                 $(".btn-save-roles").css("display","");
    //                 $(".btn-loading").css("display","none");
    //                 $("#FormEditRoles").trigger("reset");
    //                 $("#editRolesModal").modal("hide");
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Sukses',
    //                     text: 'Berhasil Memperbarui Role',
    //                     timer: 1200,
    //                     showConfirmButton: false
    //                 });
    //             },
    //             error: function(err){
    //                 console.log(err);
    //             }
    //         })
    //     }else{
    //         $(".btn-close").css("display","");
    //         $(".btn-save-roles").css("display","");
    //         $(".btn-loading").css("display","none");
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Form tidak boleh kosong!',
    //             timer: 1200,
    //             showConfirmButton: false
    //         });
    //     }

    // });
    
});