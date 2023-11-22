<div class="sidebar w-[50px] sm:w-[255px]">
    <div class="bar block sm:hidden"><i class="bx bx-menu"></i></div>
    <div class="side-logo justify-center right-[45px] sm:right-0">
        <div class="img">
            <a href="/">
                <img src="{{ url('img/logo.png') }}" alt="image" />
            </a>
        </div>
        <a href="{{ url('/') }}" class="opacity-0 invisible sm:opacity-100 sm:visible">
            MyWallet
        </a>
    </div>
    <div class="side-list">
        <ul>
            <span class="layout">MAIN</span>
            <li class="{{ Request::is('/', 'dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}"><i class="bx bxs-dashboard"></i><span>Dashboard</span></a>
            </li>
            <div class="menu">
                <li class="{{ Request::is('pembelian*', 'rekening*', 'riwayat*') ? 'active' : '' }}">
                    <div class="menu-name">
                        <i class="bx bxs-wallet"></i>
                        <span>Wallet</span>
                        <span class="chevron"><i class="bx bx-chevron-right"></i></span>
                    </div>
                    <ul class="h-0 overflow-hidden sm:h-full sm:overflow-visible">
                        <li>
                            <a href="{{ url('pembelian') }}" class="{{ Request::is('pembelian*') ? 'active' : '' }}"><i
                                    class="bx bxs-circle"></i><span>Pembelian</span></a>
                        </li>
                        <li>
                            <a href="{{ url('rekening') }}" class="{{ Request::is('rekening*') ? 'active' : '' }}"><i
                                    class="bx bxs-circle"></i><span>Rekening</span></a>
                        </li>
                        <li>
                            <a href="{{ url('riwayat') }}" class="{{ Request::is('riwayat*') ? 'active' : '' }}"><i
                                    class="bx bxs-circle"></i><span>Riwayat</span></a>
                        </li>
                    </ul>
                </li>
            </div>
            <li class="{{ Request::is('notification*') ? 'active' : '' }}">
                <a href="{{ url('notification') }}"><i class="bx bxs-bell"></i><span>Notifikasi</span></a>
            </li>
            <li class="{{ Request::is('friendlist*', 'user*') ? 'active' : '' }}">
                <a href="{{ url('friendlist') }}"><i class="bx bxs-group"></i><span>Daftar Teman</span></a>
            </li>
            <span class="layout">SETTING</span>
            <li class="{{ Request::is('profile*') ? 'active' : '' }}">
                <a href="{{ url('profile') }}"><i class="bx bxs-user"></i><span>Profile</span></a>
            </li>
            <li>
                <a href="{{ url('/logout') }}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
            </li>
        </ul>
    </div>
    <div class="side-profile">
        <div class="img w-[35px] h-[35px] sm:w-[45px] sm:h-[45px] min-w-[35px] sm:min-w-[45px] ml-[10px] sm:ml-[20px]">
            @if (auth()->user()->img == 'user.png')
                <img src="{{ url('img/' . auth()->user()->img) }}" alt="image">
            @else
                <img src="{{ url(asset('storage/' . auth()->user()->img)) }}" alt="image">
            @endif
        </div>
        <div class="profile-name opacity-0 sm:opacity-100 invisible sm:visible">
            <h4>{{ auth()->user()->name }}</h4>
            <span>{{ auth()->user()->username }}#{{ auth()->user()->id_user }}</span>
        </div>
    </div>
</div>
