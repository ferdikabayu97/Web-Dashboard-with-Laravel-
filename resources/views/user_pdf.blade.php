<!DOCTYPE html>
<html>
<head>
<title>PDF User - Rekusaha</title>
</head>
<body>
<center>
<h1> Data Pengguna {{ ($jenis == 0 ? "Belum Aktif" : "Aktif" ) }}</h1>
<h3> Aplikasi Rek Usaha </h3>

</center>
    <font size="1">

	<table border="1">
		<tr>
			<th>ID User</th>
			<th>Nama</th>
			<th>Password</th>
			<th>Token</th>
			<th>Email</th>
            <th>Status Aktif</th>
            <th>No Verifikasi</th>
            <th>Waktu akun diupdate</th>
            <th>Waktu akun dibuat</th>
		</tr>
		@foreach($user as $p)
		<tr>
			<td>{{ $p->id_user }}</td>
			<td>{{ $p->nama }}</td>
			<td>{{ $p->password }}</td>
			<td>{{ $p->token }}</td>
            <td>{{ $p->email }}</td>
			<td>{{ ($p->active_status == 0 ? "Belum Aktif" : "Aktif" ) }}</td>
			<td>{{ $p->verification }}</td>
			<td>{{ $p->updated_at }}</td>
            <td>{{ $p->created_at }}</td>
			</td>
		</tr>
		@endforeach
	</table>
	</font>
	
</body>
</html>