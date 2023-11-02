<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ url('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth/login.css') }}">

    {{-- cdn --}}
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'
        integrity='sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=' crossorigin='anonymous'></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src='https://cdn.tailwindcss.com'></script>
    {{-- cdn --}}
</head>

<body>
    <div class="container">
        <div class="title mb-5 text-center">
            <h1 class="font-bold text-2xl md:text-3xl">My<span class="text-red-500">Wallet</span></h1>
        </div>
        <main class="w-[90%] sm:w-[90%] md:[70%] lg:max-w-[900px] md:flex">
            <div class="left w-auto sm:[50%] md:w-[45%] lg:max-w-[40%]">
                <div class="header my-5">
                    <h1>Form Register</h1>
                </div>
                <div class="form-input mt-10 mb-5 px-5">
                    <form action="{{ url('/register') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="id_user" id="id_user" />
                        <div class="input-box @error('name') is-invalid @enderror">
                            <input type="text" name="name" id="title" placeholder="Nama"
                                value="{{ old('name') }}" required />
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box @error('username') is-invalid @enderror">
                            <input type="text" name="username" id="username" placeholder="username"
                                value="{{ old('username') }}" required />
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box password @error('password') is-invalid @enderror">
                            <i class="bx bxs-show" id="showPassword"></i>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <i class="bx bxs-lock-alt"></i>
                        </div>
                        <button>Register</button>
                    </form>
                </div>
                <div class="action ms-6 -mt-2 mb-4">
                    <p class="text-sm text-center">
                        Already have an account?
                        <a class="login" href="{{ url('/login') }}">Login</a>
                    </p>
                </div>
            </div>
            <div class="right img hidden md:block">
                <div class="waves">
                    <img class="a register left-[-90px] hidden md:block md:top-[100px] md:left-[-110px] lg:left-[-145px]"
                        src="{{ url('img/waves.png') }}" alt="" />
                    <img class="b register top-[180px] hidden md:block lg:top-[150px]" src="{{ url('img/waves.png') }}"
                        alt="" />
                </div>
                <div class="background"></div>
                <div class="image sm:max-w-[350px] md:max-w-[500px] lg:max-w-[550px]">
                    <img src="{{ url('img/bg.png') }}" alt="" />
                </div>
            </div>
        </main>
    </div>

    @include('sweetalert::alert')
    <script src="{{ url('js/script.js') }}"></script>
</body>

</html>
