<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<table border="1" width="100%">
	    <thead>
		    <tr>
		        <th align="center">No.</th>
		        <th align="center">Jumlah</th>
		        <th align="center">Tanggal</th>
		        <th align="center">Keterangan</th>
		    </tr>
	    </thead>
	    <tbody>
	    @foreach($pengeluaran as $no => $png)
	        <tr>
	            <td align="center">{{ $no+1 }}</td>
	            <td align="center">Rp. {{ $png->jumlah }}</td>
	            <td align="center">{{ $png->tanggal }}</td>
	            <td>{{ $png->keterangan }}</td>
	        </tr>
	    @endforeach
	    </tbody>
	</table>
</body>
</html>