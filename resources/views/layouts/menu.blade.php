@if (Auth::check()) 
<li class="{{ Request::is('jabatan*') ? 'active' : '' }}">
    <a href="{{route('jabatan.index')}}">Jabatan</a>
</li>
<li class="{{ Request::is('golongan/*') ? 'active' : '' }}">
    <a href="{{route('golongan.index')}}">Golongan</a>
</li>
<li class="{{ Request::is('katelembur*') ? 'active' : '' }}">
    <a href="{{route('katelembur.index')}}">Kategori Lembur</a>
</li>
<li class="{{ Request::is('golem*') ? 'active' : '' }}">
    <a href="{{route('golem.index')}}">Golongan & Lembur</a>
</li>
<li class="{{ Request::is('pegawai*') ? 'active' : '' }}">
    <a href="{{route('pegawai.index')}}">Pegawai</a>
</li>
<li class="{{ Request::is('lemburpegawai*') ? 'active' : '' }}">
    <a href="{{route('lemburpegawai.index')}}">Lembur Pegawai</a>
</li>
@endif
                   