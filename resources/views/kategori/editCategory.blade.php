<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{route('kategori.update',$kategories->kategori_id)}}" enctype="multipart/form-data" id="kategoriForm">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Kategori</label>
                    <input type="text" id="kategori"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nama Kategori" name="kategori" value="{{(isset($kategories))?$kategories->kategori:old('kategori')}}" required>
                </div>



                
                <button type="submit" onclick="return confirmSave()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 mt-3 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // function confirmSave() {
        //     // Validasi input di sini
        //     var kategori = document.getElementById('kategori').value;

        //     // Implementasi validasi yang sesuai dengan kebutuhan
        //     if (kategori.trim() === '') {
        //         Swal.fire({
        //         icon: 'error',
        //         title: 'Inputan Salah',
        //         text: 'Silakan periksa kembali inputan Anda.'
        //     });
        //     return false;
        //     }


        //     // Jika semua validasi berhasil, tampilkan Sweet Alert sukses
        //     Swal.fire({
        //         position: "top-end",
        //         icon: "success",
        //         title: "Your work has been saved",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });

        //     // Submit formulir
        //     document.getElementById('kategoriForm').submit();

        //     return false;
        // }

        function confirmSave() {
            var kategori = document.getElementById('kategori').value;

            if (kategori.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Inputan Salah',
                    text: 'Silakan periksa kembali inputan Anda.'
                });
                return false;
            }

            // Set aksi formulir
            document.getElementById('kategoriForm').action = "{{ route('kategori.update', $kategories->kategori_id) }}";

            // Tampilkan Sweet Alert sukses
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            });

            // Submit formulir
            document.getElementById('kategoriForm').submit();

            return false;
        }

    </script>

</x-app-layout>
