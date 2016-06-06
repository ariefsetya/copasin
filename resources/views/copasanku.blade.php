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
		$i = 1+(($data->currentPage()-1)*$data->count());
		foreach ($data as $key) {
		?>
		<tr>
			<td class="text-center"><?php echo $i.".";?></td>
			<td class="wordw-td"><a href="<?php echo url($key->hash);?>"><?php echo $key->judul;?></a></td>
			<td class="text-center"><?php echo \App\Syntax::find($key->lang)['name'];?></td>
			<td class="text-center no-phone"><?php echo date_format(date_create($key->created_at),"D, d M Y H:i:s");?></td>
			<td class="text-center no-phone"><a href="{{url($key->hash.'/edit')}}">Ubah</a></td>
			<td class="text-center no-phone"><a href="{{url($key->hash.'/hapus')}}">Hapus</a></td>
		</tr>
		<?php
		$i++;
		}
		if(sizeof($data)==0){
			?>
			<tr>
				<td colspan="6" class="text-center">No Data</td>
			</tr>
			<?php
		}
	?></tbody>
	</table>
	<div style="display: block;clear: both;">{!!$data->render()!!}</div>



@endsection