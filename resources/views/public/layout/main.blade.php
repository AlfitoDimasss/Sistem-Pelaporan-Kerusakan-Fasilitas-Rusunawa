<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link rel="icon" href="{{ asset('img/rusunawa-logo-transparrent.png') }}" type="image/x-icon"/>
    <title>SPK Rusunawa | @yield('title')</title>
    <script src="https://kit.fontawesome.com/{{ config('app.font_awesome_kit') }}.js" crossorigin="anonymous"></script>
{{--     @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-834bb2a3.css') }}">
    <script src="{{ asset('build/assets/app-44508a8e.js') }}"></script>
</head>

<body class="min-h-screen flex flex-col">
<nav class="bg-white border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-8 py-2">
        <a href="/" class="flex items-center">
            <img src="{{ asset('img/rusunawa-logo-2.png') }}" class="h-12 md:h-16 mr-3" alt="Rusunawa UB Logo" />
            <span class="hidden self-center text-2xl font-bold whitespace-nowrap md:block">Pelaporan Kerusakan
                    Digital</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                <li class="mb-2">
                    <a href="/"
                       class="block py-2 pl-3 pr-4 rounded md:p-0 {{ Request::is('/') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : false }}">Beranda</a>
                </li>
                @auth
                    <li class="mb-2">
                        <a href="/dashboard"
                           class="block py-2 pl-3 pr-4 rounded md:p-0 {{ Request::is('dashboard') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : false }}">Dashboard</a>
                    </li>
                    @if(Auth::user()->admin_status == 2)
                    <li class="mb-2">
                        <a href="/admin/buildings"
                           class="block py-2 pl-3 pr-4 rounded md:p-0 {{ Request::is('admin/') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : false }}">Admin Panel</a>
                    </li>
                    @endif
                    <li class="mb-2">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit"
                                    class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"><i
                                    class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Logout</button>
                        </form>
                    </li>
                @else
                    <li class="mb-2">
                        <a href="/login"
                           class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 {{ Request::is('login') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : false }}"><i
                                class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@if ($message = Session::get('success'))
    <div class="w-full text-green-800 bg-green-50">
        <div id="fail-alert" class="flex items-center p-4 max-w-screen-xl mx-auto" role="alert">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <div class="ml-3 text-sm font-medium">{{ $message }}</div>
            <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-800"
                    data-dismiss-target="#fail-alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
@endif
@if ($message = Session::get('fail'))
    <div class="w-full text-red-800 bg-red-50">
        <div id="fail-alert" class="flex items-center p-4 max-w-screen-xl mx-auto" role="alert">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <div class="ml-3 text-sm font-medium">{{ $message }}</div>
            <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-800"
                    data-dismiss-target="#fail-alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
@endif
<main class="flex-1 bg-gray-50 flex items-center justify-center p-4">
    @yield('content')
</main>
</body>

</html>
