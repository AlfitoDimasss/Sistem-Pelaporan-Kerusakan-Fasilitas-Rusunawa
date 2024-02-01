@extends('public.layout.main')

@section('title', 'Login')

@section('content')
    <section class="w-full p-4 md:p-0 md:w-3/4 lg:w-1/2">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <img class="h-24 mb-4" src="{{ asset('img/rusunawa-logo-transparrent.png') }}" alt="Rusunawa UB Logo">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" name="username" id="username"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="username" value="{{ old('username') }}" required>
                        </div>
                        <div>
                            <label for="password"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                   placeholder="••••••••" required>
                        </div>
                        <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Belum punya akun? <a href="/register" class="font-medium text-blue-600 hover:underline">Daftar
                                disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
