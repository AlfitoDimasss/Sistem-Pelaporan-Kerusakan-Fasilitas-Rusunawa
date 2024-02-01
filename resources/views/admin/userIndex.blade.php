@extends('public.layout.main')

@section('title', 'Dashboard')

@section('content')

    <section class="w-full p-4 md:p-0 md:w-3/4">
        <div class="max-w-screen-xl mx-auto">
            {{-- INFORMASI JUMLAH LAPORAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                <div class="border-2 border-dashed border-red-300 rounded-lg h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-blue-200 h-full">
                        <i class="fa-regular fa-building text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $buildings }}</p>
                            <p class="text-center text-2xl mt-2">Lantai Gedung</p>
                        </div>
                    </div>
                </div>
                <div class="border-2 border-dashed rounded-lg border-red-300 h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-yellow-100 h-full">
                        <i class="fa-solid fa-door-open text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $rooms }}</p>
                            <p class="text-center text-2xl mt-2">Kamar</p>
                        </div>
                    </div>
                </div>
                <div class="border-2 border-dashed rounded-lg border-red-300 h-32 md:h-64">
                    <div class="flex justify-evenly items-center bg-green-200 h-full">
                        <i class="fa-regular fa-user text-6xl lg:text-8xl"></i>
                        <div>
                            <p class="text-center text-4xl lg:text-6xl">{{ $users->count() }}</p>
                            <p class="text-center text-2xl mt-2">Pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- TABEL LAPORAN KERUSAKAN --}}
        <section class="bg-gray-50 antialiased">
            <div class="mx-auto max-w-screen-xl bg-white shadow-md rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="/admin/buildings"
                           class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2"
                           id="btnDownload">
                            <i class="fa-solid fa-building mr-2"></i>
                            Gedung
                        </a>
                        <a href="/admin/rooms"
                           class="flex items-center justify-center text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2"
                           id="btnDownload">
                            <i class="fa-solid fa-door-open mr-2"></i>
                            Kamar
                        </a>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">#</th>
                            <th scope="col" class="px-4 py-4">Nama</th>
                            <th scope="col" class="px-4 py-4">Username</th>
                            <th scope="col" class="px-4 py-4">Nomor WhatsApp</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-4 py-3">{{ $user->id }}</td>
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->username }}</td>
                                <td class="px-4 py-3">{{ $user->whatsapp_no }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <ul class="py-1 text-sm flex">
                                        <li>
                                            <button type="button" data-modal-target="deleteUserModal"
                                                    data-modal-toggle="deleteUserModal"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700 deleteBtn"
                                                    data-id="{{ $user->id }}">
                                                <i class="fa-solid fa-trash mr-1 text-red-500"></i>
                                                Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </section>

        <!-- Delete modal -->
        <div id="deleteUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteUserModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <i class="fa-solid fa-trash"></i>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin untuk menghapus data ini?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteBuildingModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10">
                            Tidak
                        </button>
                        <form id="deleteUserForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                                Ya
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const deleteBtns = document.getElementsByClassName('deleteBtn');

        Array.from(deleteBtns).forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const form = document.getElementById('deleteUserForm');
                form.action = `/api/users/${id}`
            })
        })
    </script>

@endsection
