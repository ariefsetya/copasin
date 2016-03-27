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
		<th class="no-phone" colspan="2">Aksi</th>
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
			<td class="text-center no-phone"><?php echo date_format(date_create($key->created_at),"D, d M Y H:i:s");?></td>
			<td class="text-center no-phone" colspan="2"><a href="{{url($key->hash.'/edit')}}">Ubah</a></td>
			<!-- <td class="text-center no-phone"><a onclick="return confirm('Apakah yakin ingin dihapus untuk copasan \'{{$key->judul}}\'?')" href="<?php echo url($key->hash.'/delete');?>">Hapus</a></td> -->
		</tr>
		<?php
		$i++;
		}
		}
	?></tbody>
	</table>
	{!!$data->render()!!}


@endsection