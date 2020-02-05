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
			<th>Index Tabel</th>
			<th>Id Admin</th>
			<th>Log</th>
			<th>Tabel</th>
			<th>Event</th>
            <th>Kunci Tabel</th>
            

		</tr>
		@foreach($logedit as $p)
		<tr>
			<td>{{ $p->idx_table }}</td>
			<td>{{ $p->id_admin }}</td>
			<td>{{ $p->log }}</td>
			<td>{{ $p->tabel }}</td>
            <td>{{ $p->event }}</td>
			<td>{{ $p->kunci }}</td>
			
			
		</tr>
		@endforeach
</table>
</font>
	
</body>
</html>