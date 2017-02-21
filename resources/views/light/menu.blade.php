@if(Auth::user()->permission == 'admin')
    <li class="{{ Request::is('admin/jabatan*') ? 'active' : '' }}">
        <a href="{{route('jabatan.index')}}">
            <i class="pe-7s-medal"></i>
            <p>Jabatan</p>
        </a>
    </li>

    <li class="{{ Request::is('admin/golongan*') ? 'active' : '' }}">
        <a href="{{route('golongan.index')}}">
            <i class="pe-7s-network"></i>
            <p>Golongan</p>
        </a>
    </li>

    <li class="{{ Request::is('admin/katelembur*') ? 'active' : '' }}">
        <a href="{{route('katelembur.index')}}">
            <i class="pe-7s-note2"></i>
            <p>Kategori Lembur</p>
        </a>
    </li>
@elseif(Auth::user()->permission == 'hrd')
    <li class="{{ Request::is('hrd/jabatan-hrd*') ? 'active' : '' }}">
        <a href="{{route('jabatan-hrd.index')}}">
            <i class="pe-7s-medal"></i>
            <p>Jabatan</p>
        </a>
    </li>
    <li class="{{ Request::is('hrd/pegawai*') ? 'active' : '' }}">
        <a href="{{route('pegawai.index')}}">
            <i class="pe-7s-user"></i>
            <p>Pegawai</p>
        </a>
    </li>
@elseif(Auth::user()->permission == 'keuangan')
    <li class="{{ Request::is('keuangan/golem*') ? 'active' : '' }}">
        <a href="{{route('golem.index')}}">
            <i class="pe-7s-cash"></i>
            <p>Golongan & Lembur</p>
        </a>
    </li>
    <li class="{{ Request::is('keuangan/lemburpegawai*') ? 'active' : '' }}">
        <a href="{{route('lemburpegawai.index')}}">
            <i class="ion-clock"></i>
            <p>Lembur Pegawai</p>
        </a>
    </li>
    <li class="{{ Request::is('keuangan/tunjangan*') ? 'active' : '' }}">
        <a href="{{route('tunjangan.index')}}">
            <i class="ion-plane"></i>
            <p>Tunjangan</p>
        </a>
    </li>
@elseif(Auth::user()->permission == 'pegawai')
@endif

<li class="active-pro">
    <a href="https://smkassalaambandung.sch.id/">
        <i><img src="{{asset('/image/assalaamlogo.png')}}" width="120%" height="125%"></i>
        <p>SMK ASSALAAM BANDUNG</p>
    </a>
</li>