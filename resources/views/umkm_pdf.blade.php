<!DOCTYPE html>
<html>
<head>
<title>PDF Logedit - Rekusaha</title>
</head>
<body>
<center>
<h1> Data Log edit </h1>
<h3> Website Rek usaha </h3>

    <font size="1">
    </center>

	<table border="1">
    <tr>
			<th>No</th>
			<th>Nama Perusahaan</th>
			<th>Nama Pemilik</th>
			<th>Alamat</th>
			<th>Telpon</th>
            <th>Jenis Usaha</th>
            <th>Jumlah</th>
            <th>Aset</th>
            <th>Omset</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Tahun</th>
            <th>Status Usaha</th>


		</tr>
		@foreach($umkm as $p)
		<tr>
			<td>{{ $p->no }}</td>
			<td>{{ $p->nama_perusahaan }}</td>
			<td>{{ $p->nama_pemilik }}</td>
			<td>{{ $p->alamat }}</td>
            <td>{{ $p->telp }}</td>
			<td>{{ $p->jenis_usaha }}</td>
			<td>{{ $p->jumlah }}</td>
			<td>{{ $p->aset }}</td>
            <td>{{ $p->omset }}</td>
			<td>{{ $p->kelurahan }}</td>
			<td>{{ $p->kecamatan }}</td>
			<td>{{ $p->tahun }}</td>
			<td>{{ $p->ket }}</td>

			
		</tr>
		@endforeach
</table>
</font>
	
</body>
</html>