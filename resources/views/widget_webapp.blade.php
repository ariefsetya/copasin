<!DOCTYPE html>
<html style="overflow-y:auto;">
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
    <body class="container" style="overflow-y:auto;background:transparent;">
    <div class="container">
        <h2>Copas Aja Disini</h2>
        <form method="POST" action="<?php echo url("widgz");?>" id="form_post">
            <textarea id="cops" name="isi" style="display:none;"></textarea>
            <div id="editor"></div>
            <table>
                <tr>
                    <td>Syntax Highlight</td>
                    <td><select id="lang" name="lang" style="width:106%">
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
                    <td><input type="text" name="judul" id="judul" style="width:100%">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button id="save" type="submit">Simpan</button></td>
                </tr>
            </table>
        </form>
        <div class="footer">Copyright &copy; 2015 - {{date("Y")}} {{str_replace("http://","",url())}}</div>
    </div>
    </body>
    <script src="{{url('assets/js/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/mine.js')}}"></script>
    <script src="{{url('assets/ace-builds-master/src/ace.js')}}"></script>
    <script>    
    $("#form_post").prepend('<textarea id="copas" name="isijak" style="display:none;"></textarea>');
    $("#form_post").on('submit',function () {
        //alert($("#isi").val());
        if($("textarea[name=isijak]").val()==""){
            alert('Kamu belum mengisi apapun di textarea :D');
            return false;
        }
    });
    var editor1 = ace.edit("editor");
    editor1.setTheme("ace/theme/ace");
    editor1.setShowPrintMargin(false);
    editor1.setOption("maxLines", 9999999999999999999999999);
    editor1.setOption("minLines", 7);
    editor1.setFontSize(18);
    editor1.focus();
    editor1.on('change',function () {
        $("#copas").val(editor1.getValue());
    });

    $("#lang").on('change',function () {
        editor1.session.setMode("ace/mode/"+$("#lang option:selected").val());
    });
    </script>
</html>
