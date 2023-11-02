<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyWallet | {{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/component.css') }}">

    {{-- cdn --}}
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'
        integrity='sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=' crossorigin='anonymous'></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src='https://cdn.tailwindcss.com'></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- cdn --}}

    {{-- tailwind style --}}
    <style type="text/tailwindcss">
        @layer components {
            .transition_1s {
                @apply transition-all duration-200 ease-out;
            }

            .transition_2s {
                @apply transition-all duration-100 ease-out;
            }
        }

        @layer utilities {
            .sidebar .side-list .layout {
                @apply h-0 overflow-y-hidden sm:h-[20px] transition_1s;
            }

            .sidebar .side-list ul li span {
                @apply opacity-0 invisible sm:opacity-100 sm:visible transition_2s;
            }

            .sidebar .side-list .menu .menu-name {
                @apply pointer-events-none sm:pointer-events-auto;
            }

            .content .content-body .cards {
                @apply grid-cols-1 sm:grid-cols-2;
            }

            .content .content-body .rekening .cards {
                @apply grid-cols-1 md:grid-cols-2 lg:grid-cols-3;
            }
        }
    </style>
    {{-- tailwind style --}}
</head>

<body>
    @include('layouts.sidebar')
    <main>
        @include('layouts.navbar')
        <div class="content-wrapper w-[calc(100%-50px)] sm:w-[calc(100%-255px)]">
            @yield('container')
        </div>
    </main>


    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ url('js/chart.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
</body>

</html>
