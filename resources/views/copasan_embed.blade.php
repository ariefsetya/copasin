<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta name="product" content="copasin.com">
	    <meta name="description" content="Copasin aja kemari kodingan kamu yang error :D abis itu baru posting di fb">
	    <meta name="author" content="{{url()}}">
	    <meta name="keywords" content="copas aja disini, copas, copy paste, copy, paste, copasser, error code">

	    <link href="<?php echo url('assets/css/mine.css');?>" rel="stylesheet">
	    <title>{{$data->judul}}</title>
	</head>
	<body style="margin:0px !important;padding:0;">
	<div id="editor">{{$data->isi}}</div>
    </body>
    <script src="<?php echo url('assets/js/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo url('assets/js/mine.js');?>"></script>
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 1);
    editor1.setFontSize(18);
    editor1.setReadOnly(true);
    editor1.focus();
    editor1.session.setMode("ace/mode/{{$lang->kode}}");
    </script>
</html>