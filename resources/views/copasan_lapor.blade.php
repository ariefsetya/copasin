@extends('app')

@section('header')
	<title>Laporan Diterima &raquo; Copas Aja Disini</title>
@endsection

@section('content')
<h1>Laporan diterima</h1>
<p>Terima kasih telah melaporkan copasan dengan kode <?php echo $data->hash;?> ini adalah spam, kami akan proses lebih lanjut.<br>Kami mohon maaf atas ketidaknyamanannya menggunakan layanan kami.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Salam dari kita,</p>
<p></p>
<p></p>
<p>Salam programmer Indonesia</p>
@endsection