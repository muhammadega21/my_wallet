<div class="navbar w-[calc(100%-50px)] sm:w-[calc(100%-255px)]">
    <div class="nav-left">
        <div class="search-box ms-8 sm:ms-0">
            <form action="">
                <input type="text" name="" id="" placeholder="Search..." />
                <i class="bx bx-search search-icon"></i>
                <button>Search</button>
            </form>
        </div>
    </div>
    <div class="nav-right">
        <div class="img">
            <img src="{{ url('img/' . auth()->user()->img) }}" alt="image" />
        </div>
        <div class="dropdown">
            <a href="">Setting</a>
            <a href="">Profile</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </div>
    </div>
</div>
