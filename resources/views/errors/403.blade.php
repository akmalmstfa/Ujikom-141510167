<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    	<link href="{{url('/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    	<link href="{{ url('/icon/ionicon/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    403
                </div>
                <div class="title m-b-md">
                    <b>Forbidden</b>
                </div>

                <div class="links">
    @if(Auth::user()->permission == 'admin')
        <a href="{{route('jabatan.index')}}">
            <i class="pe-7s-medal"></i> Jabatan
        </a>
        <a href="{{route('golongan.index')}}">
            <i class="pe-7s-network"></i>vGolongan
        </a>
        <a href="{{route('katelembur.index')}}">
            <i class="pe-7s-note2"></i> Kategori Lembur
        </a>
@elseif(Auth::user()->permission == 'hrd')
        <a href="{{route('jabatan-hrd.index')}}">
            <i class="pe-7s-medal"></i> Jabatan
        </a>
        <a href="{{route('pegawai.index')}}">
            <i class="pe-7s-user"></i> Pegawai
        </a>
    </li>
@elseif(Auth::user()->permission == 'keuangan')
        <a href="{{route('golem.index')}}">
            <i class="pe-7s-cash"></i> Golongan & Lembur
        </a>
        <a href="{{route('lemburpegawai.index')}}">
            <i class="ion-clock"></i> Lembur Pegawai
        </a>
        <a href="{{route('tunjangan.index')}}">
            <i class="ion-plane"></i> Tunjangan
        </a>
@elseif(Auth::user()->permission == 'pegawai')
@endif

    <a href="https://smkassalaambandung.sch.id/">
        <i><img src="{{asset('/image/assalaamlogo.png')}}" width="2%" height="2%"></i> SMK ASSALAAM BANDUNG
    </a>
                </div>
            </div>
        </div>
    </body>
</html>
