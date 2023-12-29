<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{route('matkul.store') }}" enctype="multipart/form-data" id="matkulForm">
                @csrf
                <div class="mb-6">
                    <label for="mk_kode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Mata Kuliah</label>
                    <input type="text" id="mk_kode"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('mk_kode')}}" placeholder="Kode Matkul" name="mk_kode"  required>
                    @error('mk_kode')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mk_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Mata Kuliah</label>
                    <input type="text" id="mk_nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('mk_nama')}}" placeholder="Nama Matkul" name="mk_nama"  required>
                    @error('mk_nama')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                    <input type="text" id="semester"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('semester')}}" placeholder="Semester" name="semester"  required>
                    @error('semester')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="sks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bobot SKS</label>
                    <input type="text" id="sks"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('sks')}}" placeholder="Bobot SKS" name="sks"  required>
                    @error('sks')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

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
