@extends('app')

@section('header')
	<title>Widget &raquo; Copas Aja Disini</title>
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/syntax/markup/prism.css");?>">
	<script src="<?php echo url("assets/syntax/markup/prism.js");?>"></script>
@endsection

@section('content')

	<h1>Widget</h1>
	<p>Ayo pasang widget {{str_replace("http://","",url())}} di blog kamu, bantu teman kamu buat copas kodingan yang error ^_^</p>
	<h2>Iframe Widget</h2>
	<div id="editor">&lt;iframe src="{{url('widgz')}}" style="height:350px"&gt;&lt;/iframe&gt;</div>
@endsection

@section('footer')
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 1);
    editor1.setReadOnly(true);
    editor1.setFontSize(18);
    editor1.session.setMode("ace/mode/html");
    editor1.focus();
    </script>
@endsection
