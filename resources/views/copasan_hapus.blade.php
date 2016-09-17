@extends('app')

@section('header')
	<meta property="og:url" content="<?php echo url($data->hash);?>" />
	<meta property="og:site_name" content="<?php echo $lang->name." : ".$data->judul;?>" />
	<meta property="og:title" content="<?php echo $lang->name." : ".$data->judul;?>" />
	<meta name="og:description" content="<?php echo substr(strip_tags($data->isi),0,200);?>">
	<meta name="description" content="<?php echo substr(strip_tags($data->isi),0,200);?>">
	<title>{{$data->judul}}</title>
@endsection

@section('content')
<form id="form_post" method="POST" action="{{url('delcops')}}">
<h1 class="wordw-div">Hapus Copasan "<?php echo $data->judul;?>"</h1>
<div id="editor">{{$data->isi}}</div>
<br>
<table>
    <tr>
        <td>Tuliskan kembali judul copasan </td>
        <td>
            <input type="hidden" value="judul" name="code" id="code">
            <input type="text" autocomplete="off" value="" onkeyup="cekjudul()" name="judul" id="judul">
            <input type="hidden" name="judul_{{csrf_token()}}" id="judul_{{csrf_token()}}" value="{{$data->judul}}"></td>
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"></td>
            <input type="hidden" name="id" id="id" value="{{$data->id}}">
        </td>
    </tr>
    <tr>
        <td></td>
        <td><button id="save" type="submit">Hapus</button></td>
    </tr>
</table>
</form>
@endsection

@section('footer')
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>
    function cekjudul(){
        if($("#judul").val()==$("#judul_{{csrf_token()}}").val()){
            $('#save').attr('disabled',false);
        }else{
            $('#save').attr('disabled','disabled');
        }
    }

    $("#form_post").prepend('<textarea id="copas" name="isi" style="display:none;"></textarea>');
    $("#form_post").on('submit',function () {
        if($("#judul").val()==$("#judul_{{csrf_token()}}").val()){
            
        }else{
            alert('Silakan tulis kembali judul copasan yang ingin dihapus ^_^');
            return false;
        }
    });
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setReadOnly(true);
    editor1.session.setMode("ace/mode/{{\App\Syntax::find($lang)['kode']}}");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 10);
    editor1.setFontSize(18);
    //editor1.focus();
    $("#copas").val(editor1.getValue());
    editor1.on('change',function () {
    	$("#copas").val(editor1.getValue());
    });
    $("#judul").focus();
    $("#save").attr('disabled','disabled');
    editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    $("#lang").on('change',function () {
        editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    });
    </script>
@endsection
