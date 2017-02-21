@extends('light.app')

@section('content')
<div class="card">
    <div class="content">
        Selamat Datang!
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

         demo.initChartist();

         $.notify({
             icon: 'pe-7s-gift',
             message: "Selamat Datang di <b>LaraPayroll</b> - Aplikasi penggajian dibuat dengan framework Laravel. Anda masuk sebagai <b>{{Auth::user()->permission}}</b>."

            },{
                type: 'info',
                timer: 4000
            });

        });
    </script>
@endsection
