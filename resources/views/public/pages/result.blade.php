@extends('public.layout.main')

@section('title', 'Hasil Pencarian')

@section('content')
    <section class="w-full flex items-center justify-center p-4">
        @if (count($reports) == 0)
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-base font-medium text-gray-900 text-center">Maaf, laporan kerusakan tidak ditemukan.</p>
            </div>
        @else
            <div class="w-full bg-white rounded-lg shadow py-8 px-8 md:w-3/4 lg:w-1/2">
                <div class="flex justify-between mb-6 md:mb-8">
                    <div>
                        <p class="font-semibold text-sm">LAPORAN KERUSAKAN <span
                                class="text-blue-500">#{{ $reports[0]->id }}</span></p>
                        <p class="text-[10px]">{{ $reports[0]->created_at->toFormattedDateString() }}</p>
                    </div>
                    <p class="font-semibold text-sm">{{ $reports[0]->user->name }} - {{ $reports[0]->room->name }}</p>
                </div>
                {{-- LOGO BAR --}}
                <div class="grid grid-cols-11 items-center mb-4">
                    <div class="flex md:justify-center">
                        <i class="fa-solid fa-circle-check text-2xl text-blue-500 md:text-3xl"></i>
                    </div>
                    @if ($reports[0]->status == 'received')
                        <div class="col-span-4 bg-gray-300 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-clock text-2xl text-gray-300 md:text-3xl"></i>
                        </div>
                    @elseif($reports[0]->status == 'pending')
                        <div class="col-span-4 bg-yellow-300 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-circle-check text-2xl text-yellow-300 md:text-3xl"></i>
                        </div>
                    @elseif($reports[0]->status == 'success')
                        <div class="col-span-4 bg-blue-500 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-circle-check text-2xl text-blue-500 md:text-3xl"></i>
                        </div>
                    @else
                        <div class="col-span-4 bg-red-500 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-circle text-2xl text-red-500 md:text-3xl"></i>
                        </div>
                    @endif
                    @if ($reports[0]->status == 'success')
                        <div class="col-span-4 bg-blue-500 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-circle-check text-2xl text-blue-500 md:text-3xl"></i>
                        </div>
                    @elseif($reports[0]->status == 'closed')
                        <div class="col-span-4 bg-red-500 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-circle-xmark text-2xl text-red-500 md:text-3xl"></i>
                        </div>
                    @else
                        <div class="col-span-4 bg-gray-300 h-2"></div>
                        <div class="flex justify-center">
                            <i class="fa-solid fa-clock text-2xl text-gray-300 md:text-3xl"></i>
                        </div>
                    @endif
                </div>

                {{-- KETERANGAN --}}
                <div class="grid grid-cols-3 gap-2 md:px-2 xl:px-6">
                    <div class="flex flex-col items-start">
                        <i class="fa-solid fa-file-signature text-gray-500 text-xl xl:text-2xl"></i>
                        <p class="text-xs text-left xl:text-sm">Laporan Diterima</p>
                    </div>
                    @if ($reports[0]->status == 'received')
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-file-circle-question text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-center xl:text-sm">Laporan Belum Diproses</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <i class="fa-solid fa-file-circle-question text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-end xl:text-sm">Laporan Belum Selesai</p>
                        </div>
                    @elseif ($reports[0]->status == 'pending')
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-file-signature text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-center xl:text-sm">Laporan Pending</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <i class="fa-solid fa-file-circle-question text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-end xl:text-sm">Laporan Belum Selesai</p>
                        </div>
                    @elseif($reports[0]->status == 'success')
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-file-signature text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-center xl:text-sm">Laporan Diproses</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <i class="fa-solid fa-file-circle-check text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-end xl:text-sm">Laporan Selesai</p>
                        </div>
                    @else
                        <div></div>
                        <div class="flex flex-col items-end">
                            <i class="fa-solid fa-file-circle-xmark text-gray-500 text-xl xl:text-2xl"></i>
                            <p class="text-xs text-end xl:text-sm">Laporan Ditutup</p>
                        </div>
                    @endif
                </div>
                <div class="relative overflow-x-auto mt-8">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Catatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Petugas
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reports[0]->histories as $history)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $history->created_at }}
                                </th>
                                <td class="px-6 py-4">
                                    @if ($history->status === 'pending')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                    @elseif ($history->status === 'success')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                                    @elseif($history->status === 'closed')
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Ditutup</span>
                                    @else
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Diterima</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $history->notes }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::ucfirst($history->officer) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </section>
@endsection
