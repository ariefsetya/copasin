<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta name="product" content="{{url()}}">
	    <meta name="author" content="{{url()}}">
	    <meta name="keywords" content="copas aja disini, copas, copy paste, copy, paste, copasser">
	    <meta property="og:type" content="article" />
	    <meta property="og:image" content="{{url('assets/images/ogimage.png')}}" />
	    <meta property="article:publisher" content="https://www.facebook.com/copasin.id" />
	    <meta property="article:author" content="https://www.facebook.com/copasin.id" />
	    <link rel="publisher" href="https://plus.google.com/+Copasinajadisini/"/>

	    <link href="{{url('assets/images/icon.png')}}" rel="shortcut icon">
	    <link href="{{url('assets/images/icon.png')}}" rel="favicon">
	    <link href="{{url('assets/css/mine.css')}}" rel="stylesheet">

        @yield('header')
        </head>
    <body class="container">
    <div class="black-top"></div>
    <div class="container">
        <div class="main-menu">

            <div class="place-right">
                @if(Auth::check())
                    Hi, {{Auth::user()->name}}
                @endif
            </div>
            <ul>
                <li><a href="{{url()}}">buat baru</a></li><span class="no-phone">/</span>
                @if(Auth::check())
                <li><a href="{{url('copasanku')}}">copasanku</a></li><span class="no-phone">/</span>
                @endif
                <li><a href="{{url('copasan')}}">copasan publik</a></li><span class="no-phone">/</span>
                <li><a href="{{url('widget')}}">widget</a></li><span class="no-phone">/</span>
                <li><a href="{{url('faq')}}">pertanyaan berulang</a></li><span class="no-phone">/</span>
                <li><a href="{{url('kita')}}">tentang kita</a></li><span class="no-phone">/</span>
                @if(!Auth::check())
                <li><a href="{{url('gabung')}}">gabung</a></li><span class="no-phone">/</span>
                <li><a href="{{url('masuk')}}">masuk</a></li>
                @endif
                @if(Auth::check())
                <li><a href="{{url('keluar')}}">keluar</a></li>
                @endif
            </ul>
        </div>
       @yield('content')
        <div class="footer">Copyright &copy; 2015 - {{date("Y")}} {{str_replace("http://","",url())}}</div>
    </div>
    </body>
    <script src="{{url('assets/js/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/mine.js')}}"></script>
    @yield('footer')
</html>
