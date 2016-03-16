@extends('app')

@section('header')
	    <meta property="og:url" content="http://copasin.com/" />
	    <meta name="description" content="Copasin aja kemari kodingan kamu yang error :D abis itu baru posting di fb">
	    <title>Buat Baru &raquo; Copas Aja Disini</title>
@endsection

@section('content')
<h1>Copas Aja Disini</h1>
<form method="POST" action="<?php echo url("savecops");?>" id="form_post">
<div id="editor"></div>
<br>
<table>
	<tr>
		<td>Syntax Highlight</td>
		<td><select id="lang" name="lang">
			@foreach($syntax as $key)
				<option value="{{$key->kode}}">{{$key->name}}</option>
			@endforeach
		</select></td>
	</tr>
	<tr class="no-phone">
		<td>Kadaluarsa</td>
		<td><select id="expires" name="expires" class="cs-select cs-skin-border">
			@foreach($expires as $key)
			<option value="{{$key->waktu}}">{{$key->info}}</option>
			@endforeach
		</select></td>
	</tr>
	<tr class="no-phone">
		<td>Publik</td>
		<td><select name="jenis" id="jenis" class="cs-select cs-skin-border">
			<option value="0">Ya</option>
			<option value="1">Tidak</option>
		</select></td>
	</tr>
	<tr>
		<td>Judul</td>
		<td><input type="text" name="judul" id="judul">
		<input type="hidden" name="_token" id="token" value="{{csrf_token()}}"></td>
	</tr>
	<tr>
		<td></td>
		<td><button id="save" type="submit">Simpan</button></td>
	</tr>
</table>
</form>
@endsection

@section('footer')
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    
	$("#form_post").prepend('<textarea id="copas" name="isi" required style="display:none;"></textarea>');
    
    var editor1 = ace.edit("editor");
//    editor1.setTheme("ace/theme/ace");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 10);
    editor1.setFontSize(18);
    editor1.focus();
    editor1.on('change',function () {
    	$("#copas").val(editor1.getValue());
    });

    $("#lang").on('change',function () {
    	editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    });
    </script>
@endsection
