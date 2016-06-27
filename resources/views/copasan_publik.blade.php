@extends('app')

@section('header')
	<title>Copasan Publik &raquo; Copas Aja Disini</title>
@endsection

@section('content')

	<h1>Copasan Publik</h1>
	<table class="table">
	<thead>
		<th class="nomor"></th>
		<th>Judul</th>
		<th class="syntax">Syntax</th>
		<th class="no-phone waktu">Waktu</th>
	</thead>
	<tbody>
	<?php
		$i = 1;
		foreach ($data as $key) {
		?>
		<tr>
			<td class="text-center"><?php echo $i.".";?></td>
			<td class="wordw-td"><a href="<?php echo url($key->hash);?>"><?php echo $key->judul;?></a></td>
			<td class="text-center"><?php echo \App\Syntax::find($key->lang)['name'];?></td>
			<td class="text-center no-phone"><?php echo date_format(date_create($key->created_at),"D, d M Y H:i:s");?></td>
		</tr>
		<?php
		$i++;
		}
	?></tbody>
	</table>

@endsection