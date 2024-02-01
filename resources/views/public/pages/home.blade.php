@extends('public.layout.main')

@section('title', 'Beranda')

@section('content')
    <section class="w-full p-4 md:p-0 md:w-3/4 lg:w-1/2">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="/create"
                       class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"><i
                            class="fa-solid fa-plus mr-2"></i>
                        Buat Laporan
                    </a>
                    <form class="space-y-4 md:space-y-6" action="/reports">
                        <div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fa-solid fa-hashtag text-gray-500"></i>
                                </div>
                                <input type="search" id="default-search"
                                       class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Nomor laporan" name="search" required>
                                <button type="submit"
                                        class="text-white absolute
                                    right-2.5 bottom-2.5 bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
