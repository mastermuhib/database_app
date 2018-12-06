<!DOCTYPE html>
<html>
	<head>
<title>Tabel Search Bootstrap dan Javascript</title>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.no-icons.min.css" rel="stylesheet">
<link href="{{ ('cobi/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<script type="text/javascript" async="" src="{{asset('assets/js/search.js')}}"></script>
	</head>
	<body>
<section class="container">

	<h2>Tabel Search Bootstrap dan Javascript</h2>

	<input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtrer" />

	<table class="order-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Jin Toples</td>
				<td>jin.doe@gmail.com</td>
				<td>0123456789</td>
				<td>99</td>
			</tr>
			<tr>
				<td>Jane Toples</td>
				<td>jane@toples.org</td>
				<td>9876543210</td>
				<td>349</td>
			</tr>
			<tr>
				<td>Rengo Kolas</td>
				<td>begi@batman.com</td>
				<td>6754328901</td>
				<td>199</td>
			</tr>
		</tbody>
	</table>

</section>

	</body>
</html>