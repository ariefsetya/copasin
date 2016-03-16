@extends('app')

@section('header')
	<title>Copasanku &raquo; Copas Aja Disini</title>
@endsection

@section('content')

	<h1>Copasanku</h1>
	<table class="table">
	<thead>
		<th></th>
		<th>Judul</th>
		<th>Syntax</th>
		<th class="no-phone">Waktu</th>
	</thead>
	<tbody>
	<?php
		$i = 1;
		foreach ($data as $key) {
		if(!$func->kadal($key->created_at,$key->expires)){
		?>
		<tr>
			<td class="text-center"><?php echo $i.".";?></td>
			<td><a href="<?php echo url($key->hash);?>"><?php echo $key->judul;?></a></td>
			<td class="text-center"><?php echo $func->get_lang($key->lang)['name'];?></td>
			<td class="text-center no-phone"><?php echo $key->created_at;?></td>
		</tr>
		<?php
		$i++;
		}
		}
	?></tbody>
	</table>


@endsection