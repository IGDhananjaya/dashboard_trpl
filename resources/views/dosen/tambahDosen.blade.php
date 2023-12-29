<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{route('dosen.store') }}" enctype="multipart/form-data" id="dosenForm">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Dosen</label>
                    <input type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('name')}}" placeholder="Nama Dosen" name="name"  required>
                        @error('name')
                                <div class="text-xs text-red-800">{{$message}}</div>
                        @enderror
                </div>

                <div class="mb-6">
                    <label for="dosen_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Dosen</label>
                    <input type="text" id="dosen_code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('dosen_code')}}" placeholder="Kode Dosen" name="dosen_code"  required>
                        @error('dosen_code')
                                <div class="text-xs text-red-800">{{$message}}</div>
                        @enderror
                </div>

                <div class="mb-6">
                    <label for="skill" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kemampuan Dosen</label>
                    <input type="text" id="skill"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('skill')}}" placeholder="Skill" name="skill"  required>
                    @error('skill')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="certified" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sertifikasi Dosen</label>
                    <input type="text" id="certified"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('certified')}}" placeholder="certified" name="certified"  required>
                    @error('certified')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                    <input type="text" id="nip"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{old('nip')}}" placeholder="nip" name="nip"  required>
                    @error('nip')
                        <div class="text-xs text-red-800">{{$message}}</div>
                    @enderror
                </div>

                {{-- <div class="mb-6">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="P" @if(old('gender') == 'P') selected @endif>Perempuan</option>
                        <option value="L" @if(old('gender') == 'L') selected @endif>Laki-laki</option>
                    </select>
                </div> --}}
                
                <div class="mb-6">
                    <label>Gender:</label>
                    <div class="flex items-center">
                        <input type="radio" id="gender_p" name="gender" value="P" @if(old('gender') == 'P' || !old('gender')) checked @endif>
                        <label for="gender_p" class="ml-2">Perempuan</label>
                
                        <input type="radio" id="gender_l" name="gender" value="L" @if(old('gender') == 'L') checked @endif class="ml-4">
                        <label for="gender_l" class="ml-2">Laki-laki</label>
                    </div>
                </div>                
                

                <div class="col-span-6 sm:col-span-3">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Foto Dosen</label>
                    <input type="file" name="photo" id="photo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('photo')
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
                // Validasi input di sini
                var name = document.getElementById('name').value;
                var dosenCode = document.getElementById('dosen_code').value;
                var skill = document.getElementById('skill').value;
                var certified = document.getElementById('certified').value;
                var nip = document.getElementById('nip').value;

                // Implementasi validasi yang sesuai dengan kebutuhan
                if (name.trim() === '' || dosenCode.trim() === '' || skill.trim() === '' || certified.trim() === '' || nip.trim() === '') {
                    Swal.fire({
                    icon: 'error',
                    title: 'Inputan Salah',
                    text: 'Silakan periksa kembali inputan Anda.'
                });
                return false;
                }

                // Validasi untuk nip harus angka
                if (isNaN(nip)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'NIP harus berupa angka',
                        text: 'Silakan masukkan NIP yang valid.'
                    });
                    return false;
                }

                // Validasi untuk name harus huruf
                if (/\d/.test(name)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Nama tidak boleh mengandung angka',
                        text: 'Silakan masukkan nama yang valid.'
                    });
                    return false;
                }

                // Jika semua validasi berhasil, tampilkan Sweet Alert sukses
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: false,
                    timer: 1500
                });

                // Submit formulir
                document.getElementById('dosenForm').submit();

                return false;
            }
        </script>

</x-app-layout>
