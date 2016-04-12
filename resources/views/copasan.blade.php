@extends('app')

@section('header')
	<meta property="og:url" content="<?php echo url($data->hash);?>" />
	<meta property="og:site_name" content="<?php echo $data->judul;?>" />
	<meta property="og:title" content="<?php echo $data->judul;?>" />
	<meta name="og:description" content="<?php echo substr(strip_tags($data->isi),0,200);?>">
	<meta name="description" content="<?php echo substr(strip_tags($data->isi),0,200);?>">
	<title>{{$data->judul}}</title>
@endsection

@section('content')
<h1 class="wordw-div"><?php echo $data->judul;?></h1>
<span><?php echo "oleh ".($user)." / tanggal ".date_format(date_create($data->created_at),"d F Y")." / jam ".date_format(date_create($data->created_at),"H:i:s")." / syntax ".$lang->name." / kadaluarsa ".$exp." / <a href='".url("embed/".$data->hash)."'>embed</a>";?>@if(Auth::check()) @if(\App\Copas::where('hash',$data->hash)->first()['idpengguna']==Auth::user()->id) / <a href="{{url($data->hash.'/edit')}}">edit</a> @endif @endif <?php echo" / ".($data->spam==0?"<a href='".url("lapor/".$data->hash)."'>lapor spam</a>":"Dilaporkan sebagai spam");?></span>
<div id="editor">{{$data->isi}}</div>
<h1>RAW copasan</h1>
<textarea id="copylagi"><?php echo $data->isi;?></textarea>

@endsection

@section('footer')
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setReadOnly(true);
    editor1.session.setMode("ace/mode/{{$lang->kode}}");
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
