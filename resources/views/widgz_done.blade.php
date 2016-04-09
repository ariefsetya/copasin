<!DOCTYPE html>
<html style="overflow:hidden;">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta name="product" content="{{url()}}">
	    <meta name="author" content="{{url()}}">
	    <meta name="keywords" content="copas aja disini, copas, copy paste, copy, paste, copasser">
	    <link href="{{url('assets/images/icon.png')}}" rel="shortcut icon">
	    <link href="{{url('assets/images/icon.png')}}" rel="favicon">
	    <link href="{{url('assets/css/mine.css')}}" rel="stylesheet">
        <title>Widgz &raquo; Copas Aja Disini</title>
        </head>
    <body class="container" style="overflow:hidden;background:transparent;">
    <div class="container">
		<h1>{{$data->judul}}</h1>
		<p>URL : <a target="_blank" href="{{url($data->hash)}}">{{url($data->hash)}}</a></p>
		<p><a href="{{url('widgz')}}">buat baru</a> - <a target="_blank" href="{{url()}}">ke {{url()}}</a></p>
        <div class="footer">Copyright &copy; 2015 - {{date("Y")}} {{str_replace(url(),"http://","")}}</div>
    </div>
    </body>
    <script src="{{url('assets/js/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/mine.js')}}"></script>
</html>
