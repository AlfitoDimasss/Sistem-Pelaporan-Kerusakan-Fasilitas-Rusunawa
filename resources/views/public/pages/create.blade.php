@extends('public.layout.main')

@section('title', 'Buat Laporan Baru')

@section('content')
    <section class="w-full p-4 md:p-0 md:w-3/4 lg:w-1/2">
        <div class="py-8 px-4 mx-auto w-full lg:py-16 rounded-lg shadow-md bg-white">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Buat Laporan Kerusakan Baru</h2>
            <form action="/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="building_id" class="block mb-2 text-sm font-medium text-gray-900">Gedung</label>
                        <select id="building_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required autofocus>
                            <option>-- Pilih Gedung --</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="room_id" class="block mb-2 text-sm font-medium text-gray-900">Kamar</label>
                        <select id="room_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="room_id" required>
                            <option>-- Pilih Kamar --</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul Kerusakan</label>
                        <input type="text" name="title" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                               placeholder="Deskripsi singkat kerusakan" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="mt-2 text-xs text-red-600">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Foto Kerusakan</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 mb-2"
                            type="file" id="image" name="image" accept="image/*" capture="user"
                            onchange="previewImage()" required>
                        <img class="img-preview hidden">
                        @error('image')
                        <div class="mt-2 text-xs text-red-600">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                            Kerusakan</label>
                        <textarea id="description" rows="8"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Tuliskan deskripsi detail kerusakan" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="mt-2 text-xs text-red-600">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800"><i
                            class="fa-solid fa-plus mr-2"></i>
                        Tambah Laporan
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        const buildingDropdown = document.getElementById('building_id');
        buildingDropdown.addEventListener('change', function() {
            console.log('dropdown change');
            const buildingId = this.value;
            const roomDrowdown = document.getElementById('room_id');
            roomDrowdown.innerHTML = '<option>-- Pilih Kamar --</option>';

            axios.get(`/api/rooms/${buildingId}`)
                .then(function(response) {
                    const rooms = response.data;
                    rooms.forEach((room) => {
                        roomDrowdown.innerHTML += `<option value="${room.id}">${room.name}</option>`;
                    });
                });
        })

        function previewImage() {
            const image = document.getElementById('image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
