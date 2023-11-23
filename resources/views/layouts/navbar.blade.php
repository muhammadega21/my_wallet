<div class="navbar w-[calc(100%-50px)] sm:w-[calc(100%-255px)]">
    <div class="nav-left">
    </div>
    <div class="nav-right">
        <div class="welcome">
            <span>Selamat Datang,</span>
            <h4 class="font-semibold">{{ auth()->user()->name }}</h4>
        </div>
        <div class="img">
            @if (auth()->user()->img == 'user.png')
                <img src="{{ url('img/' . auth()->user()->img) }}" alt="image">
            @else
                <img src="{{ url(asset('storage/' . auth()->user()->img)) }}" alt="image">
            @endif
        </div>
        <div class="dropdown">
            <a href="{{ url('/profile') }}">Profile</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </div>
    </div>
</div>
