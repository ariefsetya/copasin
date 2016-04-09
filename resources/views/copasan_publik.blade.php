@extends('app')

@section('header')
	<title>Copasan Publik &raquo; Copas Aja Disini</title>
@endsection

@section('content')

	<h1>Copasan Publik</h1>
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
		<tr title="{{$key->spam==1?"Dilaporkan sebagai spam":""}}">
			<td class="text-center" style="{{$key->spam==1?"background:red !important":""}}"><?php echo $i.".";?></td>
			<td class="wordw-td" style="{{$key->spam==1?"background:red !important":""}}">@if($key->spam==0) <a href="<?php echo url($key->hash);?>"> @endif {!!$key->spam==1?"<s>":""!!}<?php if($key->spam==1){echo substr($key->judul,0,strlen($key->judul)-2)."xx";}else{echo $key->judul;}?>{!!$key->spam==1?"</s>":""!!} @if($key->spam==0)</a>@endif</td>
			<td style="{{$key->spam==1?"background:red !important":""}}" class="text-center"><?php echo $func->get_lang($key->lang)['name'];?></td>
			<td style="{{$key->spam==1?"background:red !important":""}}" class="text-center no-phone"><?php echo date_format(date_create($key->created_at),"D, d M Y H:i:s");?></td>
		</tr>
		<?php
		$i++;
		}
		}
	?></tbody>
	</table>


@endsection