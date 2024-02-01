@extends('public.layout.main')

@section('title', 'Dashboard')

@section('content')
    <section class="w-full p-4 md:p-0 md:w-3/4">
        <div class="max-w-screen-xl mx-auto">
            {{-- INFORMASI JUMLAH LAPORAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                <div class="border-2 border-dashed border-red-300 rounded-lg h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-blue-200 h-full">
                        <i class="fa-regular fa-flag text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $receivedReports }}</p>
                            <p class="text-center text-2xl mt-2">Laporan Diterima</p>
                        </div>
                    </div>
                </div>
                <div class="border-2 border-dashed rounded-lg border-red-300 h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-yellow-100 h-full">
                        <i class="fa-solid fa-circle-exclamation text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $pendingReports }}</p>
                            <p class="text-center text-2xl mt-2">Laporan Pending</p>
                        </div>
                    </div>
                </div>
                <div class="border-2 border-dashed rounded-lg border-red-300 h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-green-200 h-full">
                        <i class="fa-regular fa-square-check text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $successReports }}</p>
                            <p class="text-center text-2xl mt-2">Laporan Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- TABEL LAPORAN KERUSAKAN --}}
        <section class="bg-gray-50 antialiased">
            <div class="mx-auto max-w-screen-xl bg-white shadow-md rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form action="/dashboard">
                            <div class="flex">
                                <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300"
                                        type="button">
                                    <i class="fa-solid fa-filter mr-2"></i>
                                    Filter
                                    <i class="fa-solid fa-chevron-down ml-2"></i>
                                </button>
                                <div id="dropdown" class="hidden z-10 bg-white rounded-lg shadow w-44 p-4">
                                    <h6 class="mb-2 text-sm font-medium text-gray-900">Status Laporan</h6>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input id="status1" type="checkbox" value="received" name="statuses[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="status1"
                                                   class="ml-2 text-sm font-medium text-gray-900">Diterima</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="status2" type="checkbox" value="pending" name="statuses[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="status2"
                                                   class="ml-2 text-sm font-medium text-gray-900">Pending</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="status3" type="checkbox" value="success" name="statuses[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="status3"
                                                   class="ml-2 text-sm font-medium text-gray-900">Selesai</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="status4" type="checkbox" value="closed" name="statuses[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="status4"
                                                   class="ml-2 text-sm font-medium text-gray-900">Ditutup</label>
                                        </li>
                                    </ul>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Bulan</h6>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input id="month1" type="checkbox" value="1" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month1"
                                                   class="ml-2 text-sm font-medium text-gray-900">Januari</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month2" type="checkbox" value="2" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month2"
                                                   class="ml-2 text-sm font-medium text-gray-900">Februari</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month3" type="checkbox" value="3" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month3"
                                                   class="ml-2 text-sm font-medium text-gray-900">Maret</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month4" type="checkbox" value="4" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month4"
                                                   class="ml-2 text-sm font-medium text-gray-900">April</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month5" type="checkbox" value="5" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month5"
                                                   class="ml-2 text-sm font-medium text-gray-900">Mei</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month6" type="checkbox" value="6" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month6"
                                                   class="ml-2 text-sm font-medium text-gray-900">Juni</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month7" type="checkbox" value="7" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month7"
                                                   class="ml-2 text-sm font-medium text-gray-900">Juli</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month8" type="checkbox" value="8" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month8"
                                                   class="ml-2 text-sm font-medium text-gray-900">Agustus</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month9" type="checkbox" value="9" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month9"
                                                   class="ml-2 text-sm font-medium text-gray-900">September</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month10" type="checkbox" value="10" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month10"
                                                   class="ml-2 text-sm font-medium text-gray-900">October</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month11" type="checkbox" value="11" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month11"
                                                   class="ml-2 text-sm font-medium text-gray-900">November</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="month12" type="checkbox" value="12" name="months[]"
                                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="month12"
                                                   class="ml-2 text-sm font-medium text-gray-900">December</label>
                                        </li>
                                    </ul>
                                    <h6 class="my-3 text-sm font-medium text-gray-900">Tahun</h6>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-center">
                                            <input id="year1" type="radio" value="2023" name="year"
                                                   class="w-4 h-4 rounded-full bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2">
                                            <label for="year1"
                                                   class="ml-2 text-sm font-medium text-gray-900">2023</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="year2" type="radio" value="2024" name="year"
                                                   class="w-4 h-4 rounded-full bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                                            <label for="year2"
                                                   class="ml-2 text-sm font-medium text-gray-900">2024</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown"
                                           class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Search" name="search">
                                    <button type="submit"
                                            class="absolute top-0 right-0 py-2.5 px-4 h-full text-sm font-medium text-white bg-black rounded-r-lg border border-black focus:ring-4 focus:outline-none focus:ring-gray-300">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (Auth::user()->admin_status != 0)
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <a href="/create"
                               class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Buat Laporan
                            </a>
                            <a href="#"
                               class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2"
                               id="btnDownload">
                                <i class="fa-solid fa-download mr-2"></i>
                                Unduh Laporan
                            </a>
                        </div>
                    @endif
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">Tanggal</th>
                            <th scope="col" class="px-4 py-4">No Laporan</th>
                            <th scope="col" class="px-4 py-4">Status</th>
                            <th scope="col" class="px-4 py-4">Kamar</th>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Keterangan</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reports as $report)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $report->created_at->toFormattedDateString() }}</th>
                                <td class="px-4 py-3">#{{ $report->id }}</td>
                                <td class="px-4 py-3">
                                    @if ($report->status === 'pending')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                    @elseif ($report->status === 'success')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                                    @elseif($report->status === 'closed')
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Ditutup</span>
                                    @else
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Diterima</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $report->room->name }}</td>
                                <td class="px-4 py-3 max-w-[12rem] truncate">{{ $report->user->name }}</td>
                                <td class="px-4 py-3">{{ $report->title }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <ul class="py-1 text-sm flex">
                                        @if (Auth::user()->admin_status != 0)
                                            <li>
                                                <button type="button" data-modal-target="updateReport"
                                                        data-modal-toggle="updateReport"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700 updateBtn"
                                                        data-id="{{ $report->id }}">
                                                    <i class="fa-solid fa-pen-to-square mr-1 text-green-500"></i>
                                                    Edit
                                                </button>
                                            </li>
                                        @endif
                                        <li>
                                            <button type="button" data-modal-target="readProductModal"
                                                    data-modal-toggle="readProductModal"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700 readBtn"
                                                    data-id="{{ $report->id }}">
                                                <i class="fa-solid fa-eye mr-1 text-blue-500"></i>
                                                Detail
                                            </button>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            </div>
        </section>
        {{-- MODAL BOX UPDATE --}}
        <div id="updateReport" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">Update Laporan</h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="updateReport">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form id="updateReportForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status
                                    Laporan</label>
                                <select id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="status" required autofocus>
                                    <option>-- Pilih Status --</option>
                                </select>
                            </div>
                            <div>
                                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Keterangan
                                    (Opsional)</label>
                                <textarea id="notes" rows="8"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Tuliskan update laporan" name="notes"></textarea>
                            </div>
                            <div class="w-full">
                                <label for="officer" class="block mb-2 text-sm font-medium text-gray-900">Petugas</label>
                                <select id="officer" name="officer"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <option value="samsul">Samsul</option>
                                    <option value="darsono">Darsono</option>
                                    <option value="sudi">Sudi</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-4">
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><i
                                    class="fa-solid fa-pen-to-square mr-1"></i>Update
                                Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- MODAL BOX READ --}}
        <div id="readProductModal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                        <div class="text-lg text-gray-900 md:text-xl">
                            <h3 class="font-semibold" id="readModalTitle"></h3>
                            <p class="font-normal text-xs" id="readModalDate"></p>
                        </div>
                        <div>
                            <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex"
                                    data-modal-toggle="readProductModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <img id="readModalImage">
                    </div>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900" id="readModalTitle2"></dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5" id="readModalDescription"></dd>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Riwayat Laporan</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5">
                            <div class="relative overflow-x-auto">
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
                                    <tbody id="readModalHistory">
                                    </tbody>
                                </table>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <script>
        const updateBtns = document.getElementsByClassName('updateBtn');

        Array.from(updateBtns).forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;

                axios.get(`api/reports/${id}`)
                    .then(function(response) {
                        const data = response.data[0].status;
                        const statusDropdown = document.getElementById('status');
                        statusDropdown.innerHTML = '<option>-- Pilih Status --</option>';
                        if (data == 'received') {
                            statusDropdown.innerHTML +=
                                '<option value="pending">Pending</option><option value="success">Selesai</option><option value="closed">Ditutup</option>'
                        } else if (data == 'pending') {
                            statusDropdown.innerHTML +=
                                '<option value="success">Selesai</option>'
                        }
                    })
                const form = document.getElementById('updateReportForm');
                form.action = `/api/reports/${id}`
            })
        })

        const readBtns = document.getElementsByClassName('readBtn');

        Array.from(readBtns).forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                axios.get(`api/reports/${id}`)
                    .then(function(res) {
                        const data = res.data[0];
                        const title = document.getElementById('readModalTitle');
                        title.innerHTML = '';
                        title.innerHTML = `${data.user.name} - ${data.room.name}`;
                        if (data.status == 'pending') {
                            title.innerHTML +=
                                `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Pending</span>`;
                        } else if (data.status == 'success') {
                            title.innerHTML +=
                                `<span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Selesai</span>`;
                        } else if (data.status == 'closed') {
                            title.innerHTML +=
                                `<span class="bg-gray-100 text-gray-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Ditutup</span>`;
                        } else {
                            title.innerHTML +=
                                `<span class="bg-blue-100 text-blue-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Diterima</span>`;
                        }

                        const date = document.getElementById('readModalDate');
                        date.innerHTML = '';
                        date
                            .innerHTML = `#${data.id} - ${new Date(data.created_at).toLocaleDateString()}`;
                        const image = document.getElementById('readModalImage');
                        image.src = '';
                        image.src =
                            `storage/${data.image}`;
                        const title2 = document.getElementById('readModalTitle2');
                        title2
                            .innerHTML = '';
                        title2.innerHTML = `${data.title}`;
                        const description = document.getElementById('readModalDescription');
                        description
                            .innerHTML = '';
                        description.innerHTML = `${data.description}`;
                        const history = document.getElementById('readModalHistory');
                        history.innerHTML = '';
                        for (let i = 0; i < data.histories.length; i++) {
                            let status = '';
                            if (data.histories[i].status == 'pending') {
                                status =
                                    `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Pending</span>`;
                            } else if (data.histories[i].status == 'success') {
                                status =
                                    `<span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Selesai</span>`;
                            } else if (data.histories[i].status == 'closed') {
                                status =
                                    `<span class="bg-gray-100 text-gray-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Ditutup</span>`;
                            } else {
                                status =
                                    `<span class="bg-blue-100 text-blue-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">Diterima</span>`;
                            }
                            history.innerHTML += `
                                <tr class="bg-white border-b">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        ${new Date(data.histories[i].created_at).toLocaleString()}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${status}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.histories[i].notes}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${data.histories[i].officer}
                                    </td>
                                </tr>
                            `
                        }
                        // if (data.histories[data.histories.length - 1].notes != null) {
                        //     response.innerHTML =
                        //         `<p>${data.histories[data.histories.length - 1].notes}</p><p>- ${data.histories[data.histories.length - 1].officer}</p>`;
                        // } else {
                        //     response.innerHTML =
                        //         `<p>Laporan kerusakan fasilitas diterima.</p><p>- System</p>`;
                        // }
                    })
            })
        })

        window.addEventListener('load', function() {
            const query = window.location.search;
            const btnDownload = document.getElementById('btnDownload');
            if (btnDownload) {
                btnDownload.href = `/dashboard/download${query}`;
            }
        })
    </script>
@endsection
