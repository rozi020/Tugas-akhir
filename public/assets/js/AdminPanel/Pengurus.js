$(document).ready(function() {

    //DATATABLE PENGURUS
	LoadPengurus();
	function LoadPengurus() {
		$('#datatable-pengurus').load('/pengurus/load/table-pengurus', function() {
			$('#table-pengurus').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/pengurus/load/data-pengurus',
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
						data: 'name',
						name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'text-center'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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

    //OPEN MODAL TAMBAH PENGURUS
    $("#btn-modal-pengurus").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-pengurus").css("display","");
        $(".btn-loading").css("display","none");
        $("#PengurusModal").modal("show");
    });

    //SUBMIT DATA PENGURUS
    $("body").on("submit","#FormPengurus", function(e){
        e.preventDefault()
        $(".btn-close").css("display","none")
        $(".btn-loading").css("display","")
        $(".btn-submit-pengurus").css("display","none")
        var data = $("#FormPengurus").serialize()

        $.ajax({
            type: "post",
            url: "/pengurus/add",
            data: data,
            success: function(response){
                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-pengurus").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-pengurus").css("display","")
                    $("#PengurusModal").modal("hide")
                    $("#FormPengurus").trigger("reset")
                    LoadPengurus()
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Pengurus',
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

    // OPEN MODAL EDIT PASSWORD
    $("body").on("click",".btn-edit-password",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-password").css("display","");
        $(".btn-loading").css("display","none");
        $("#EditPasswordModal").modal("show");
        var id = $(this).attr("data-id");

        $("#id_pengurus").val(id);
    })

    // SAVE EDIT PASSWORD
    $("body").on("submit","#FormEditPassword", function(e){
        e.preventDefault()
        var id = $("#id_pengurus").val();
        var data = $("#FormEditPassword").serialize();

        $(".btn-close").css("display","none");
        $(".btn-save-password").css("display","none");
        $(".btn-loading").css("display","");

        $.ajax({
            type: "post",
            url: "/pengurus/update/password/"+id,
            data: data,
            success: function(response){
                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-save-password").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    LoadPengurus();
                    $(".btn-close").css("display","");
                    $(".btn-save-password").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormEditPassword").trigger("reset");
                    $("#EditPasswordModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Password Pengurus',
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

    //HAPUS PENGURUS
    $("body").on("click",".btn-delete-pengurus",function(e){
        e.preventDefault()
        var id = $(this).attr("data-id")
        var name = $(this).attr("data-name")

        Swal.fire({
			title: 'Hapus ' + name + '?',
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
					url: "/pengurus/delete/"+id,
					success: function(response) {
						Swal.fire('Deleted!', name + ' telah dihapus.', 'success');
						LoadPengurus();
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});
    });
});