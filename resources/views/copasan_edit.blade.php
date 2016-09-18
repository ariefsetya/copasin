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
<form id="form_post" method="POST" action="{{url('updatecops')}}">
<h1 class="wordw-div">Edit Copasan "<?php echo $data->judul;?>"</h1>
<div id="editor">{{$data->isi}}</div>
<br>
<table>
    <tr>
        <td>Syntax Highlight</td>
        <td><select id="lang" name="lang">
            @foreach($syntax as $key)
                <option {{$key->id==$lang->id?"selected":""}} value="{{$key->kode}}">{{$key->name}}</option>
            @endforeach
        </select></td>
    </tr>
    <tr class="no-phone">
        <td>Kadaluarsa</td>
        <td><select id="expires" name="expires" class="cs-select cs-skin-border">
            @foreach($expires as $key)
            <option {{$key->waktu==$exp?"selected":""}} value="{{$key->waktu}}">{{$key->info}}</option>
            @endforeach
        </select></td>
    </tr>
    <tr class="no-phone">
        <td>Publik</td>
        <td><select name="jenis" id="jenis" class="cs-select cs-skin-border">
            <option {{$data->jenis==0?"selected":""}} value="0">Ya</option>
            <option {{$data->jenis==1?"selected":""}} value="1">Tidak</option>
        </select></td>
    </tr>
    <tr>
        <td>Judul</td>
        <td><input type="text" value="{{$data->judul}}" name="judul" id="judul">
        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"></td>
        <input type="hidden" name="id" id="id" value="{{$data->id}}"></td>
    </tr>
    <tr>
        <td></td>
        <td><button id="save" type="submit">Update</button></td>
    </tr>
</table>
</form>
@endsection

@section('footer')
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    

    $("#form_post").prepend('<textarea id="copas" name="isi" style="display:none;"></textarea>');
    $("#form_post").on('submit',function () {
        //alert($("#isi").val());
        if($("textarea[name=isi]").val()==""){
            alert('Kamu belum mengisi apapun di textarea :D');
            return false;
        }
    });
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setReadOnly(false);
    editor1.session.setMode("ace/mode/{{\App\Syntax::find($lang)['kode']}}");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 10);
    editor1.setFontSize(18);
    editor1.focus();
    $("#copas").val(editor1.getValue());
    editor1.on('change',function () {
    	$("#copas").val(editor1.getValue());
    });
    editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    $("#lang").on('change',function () {
        editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    });
    </script>
@endsection
