$(document).ready(function() {

    //DATATABLE HISTORY
	LoadTableHistory();
	function LoadTableHistory() {
        // AlertCount();
		$('#datatable-history').load('/history/load/table-history', function() {
			$('#table-history').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/history/load/data-history',
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
						data: 'nama',
						name: 'nama'
					},
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    }
				]
			});
		});
    }
    
});
