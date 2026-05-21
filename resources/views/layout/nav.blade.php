<nav>
    <div class="kanan">
        <img src="{{ asset('gambar/telkomAkses.png') }}" alt="logo telkom">

        <ul class="menu">
            <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                <a href="{{ route('index') }}">Persentase B2B</a>
            </li>

            <li class="{{ request()->routeIs('tiket') ? 'active' : '' }}">
                <a href="{{ route('tiket') }}">ALL B2B</a>
            </li>

            <li class="{{ request()->routeIs('pivot') ? 'active' : '' }}">
                <a href="{{ route('pivot') }}">Report B2B</a>
            </li>

            <li class="{{ request()->routeIs('tsel*') ? 'active' : '' }}">
                <a href="{{ route('tsel') }}">Tsel</a>
            </li>
        </ul>
    </div>

    <div class="profil">
        <ul>
            <li>
                <p>{{ Auth::user()->name }}</p>
            </li>
            <li>
                <a href="{{ route('logOut') }}">Logout</a>
            </li>
        </ul>
    </div>
</nav>
