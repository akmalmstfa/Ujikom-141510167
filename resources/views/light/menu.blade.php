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
    <li class="{{ Request::is('hrd/golem-hrd*') ? 'active' : '' }}">
        <a href="{{route('golem-hrd.index')}}">
            <i class="ion-coffee"></i>
            <p>Golongan & Lembur</p>
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
            <i class="ion-coffee"></i>
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
    <li class="{{ Request::is('keuangan/pegawai-tunjangan*') ? 'active' : '' }}">
        <a href="{{route('pegawai-tunjangan.index')}}">
            <i class="ion-cash"></i>
            <p>Tunjangan Pegawai</p>
        </a>
    </li>
    <li class="{{ Request::is('keuangan/penggajian*') ? 'active' : '' }}">
        <a href="{{route('penggajian.index')}}">
            <i class="pe-7s-cash"></i>
            <p>Penggajian</p>
        </a>
    </li>
@elseif(Auth::user()->permission == 'pegawai')
    <li class="{{ Request::is('pegawai/gaji*') ? 'active' : '' }}">
        <a href="{{route('gaji')}}">
            <i class="pe-7s-cash"></i>
            <p>Gaji</p>
        </a>
    </li>
@endif

<li class="active-pro">
    <a href="https://smkassalaambandung.sch.id/">
        <i><img src="{{asset('/image/assalaamlogo.png')}}" width="120%" height="125%"></i>
        <p>SMK ASSALAAM BANDUNG</p>
    </a>
</li>