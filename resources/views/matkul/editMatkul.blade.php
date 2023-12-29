<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{(isset($matkuls))?route('matkul.update',$matkuls->mk_id):route('matkul.store') }}" enctype="multipart/form-data" id="matkulForm">
                @csrf
                @if (isset($matkuls))@method('PUT')
                @endif
                <div class="mb-6">
                    <label for="mk_kode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Mata Kuliah</label>
                    <input type="text" id="mk_kode"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kode Matkul" name="mk_kode" value="{{(isset($matkuls))?$matkuls->mk_kode:old('mk_kode')}}" required>
                    @error('mk_kode')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mk_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Mata Kuliah</label>
                    <input type="text" id="mk_nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nama Matkul" name="mk_nama" value="{{(isset($matkuls))?$matkuls->mk_nama:old('mk_nama')}}" required>
                    @error('mk_nama')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                    <input type="text" id="semester"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Semester" name="semester" value="{{(isset($matkuls))?$matkuls->semester:old('semester')}}" required>
                    @error('semester')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="sks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bobot SKS</label>
                    <input type="text" id="sks"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Bobot SKS" name="sks" value="{{(isset($matkuls))?$matkuls->sks:old('sks')}}" required>
                    @error('sks')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                {{-- <div class="mb-6">
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">slug
                        Berita</label>
                    <input type="text" id="slug"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="masukan slug berita.." name="slug" required>
                </div> --}}

                {{-- <div class="mb-6">
                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        Kategori</label>
                    <select name="kategori_id" id="kategori"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($kategories as $kategori)
                            <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>

                </div> --}}
                {{-- <div class="mb-6">
                    <label for="photo">Masukan Foto</label>
                    <input type="file" name="photo" id="photo" required>

                </div>
                <div class="mb-6">
                    <label for="related_image">Masukan detail Foto</label>
                    <input multiple type="file" name="related_images[]" id="related_images" required>
                </div>
                <label for="description">description</label>
                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                <trix-editor input="description"></trix-editor> --}}
                <button type="submit" onclick="return confirmSave()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 mt-3 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function confirmSave() {
        var mk_kode = document.getElementById('mk_kode').value;
        var mk_nama = document.getElementById('mk_nama').value;
        var semester = document.getElementById('semester').value;
        var sks = document.getElementById('sks').value;

        if (mk_kode.trim() === '' || mk_nama.trim() === '' || semester.trim() === '' || sks.trim() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Inputan Salah',
                text: 'Silakan periksa kembali inputan Anda.'
            });
            return false;
        }

        // Your additional validations go here

        // If all validations pass, show success message
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        });

        document.getElementById('matkulForm').submit();
        return true;
    }
    </script>

</x-app-layout>
