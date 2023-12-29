<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <form class="mb-4" action="/dashboard/kategori">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-search-icon></x-search-icon>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search " name="search" value="{{ request('search') }}">
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex justify-end mt-3 mr-3">
                {{-- <a href="{{ route('kategori.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg" id="return">
                    Add Kategori
                </a> --}}
                <!-- Add Kategori Button -->
                <form action="{{ route('kategori.store') }}" method="POST" id="addCategoryForm">
                    @csrf
                    <input type="hidden" id="kategori" name="kategori">
                    <button type="button" onclick="confirmAddCategory()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg" id="return">
                        Add Kategori
                    </button>
                </form>
                
            </div>
            <div class="">
                <x-alert-succes></x-alert-succes>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="min-w-full table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">#</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                Kategori
                            </th>
                            {{-- <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                ID
                            </th> --}}
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @foreach ($kategories as $kategori)
                            
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-left">
                                <a href="{{ route('kategori.index', $kategori->kategori_id) }}" >
                                    {{ $kategori->kategori }}
                                </a>
                            </td>
                            {{-- <td class="px-6 py-4 text-center">{{ $kategori->kategori_id }}</td> --}}
                            <td class="px-6 py-4 flex gap-4 justify-center items-center">
                            
                                {{-- <a class=" p-2 rounded-3xl  hover:bg-yellow-400"
                                    href="{{ route('kategori.edit', $kategori->kategori_id) }}"><x-edit-logo></x-edit-logo></a> --}}
                                    <!-- Edit Button -->
                                <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST" id="editCategoryForm_{{ $kategori->kategori_id }}">
                                    @csrf
                                    @method('PUT')  <!-- atau @method('PATCH') tergantung pada konfigurasi Anda -->
                                    <input type="hidden" id="updated_kategori" name="kategori">
                                    <button type="button" onclick="confirmEditCategory({{ $kategori->kategori_id }}, '{{ $kategori->kategori }}')" class="p-2 rounded-3xl hover:bg-yellow-400">
                                        <x-edit-logo></x-edit-logo>
                                    </button>
                                </form>
                                
                                <form action="{{ route('kategori.destroy', $kategori->kategori_id) }}" method="POST" id="deleteForm_{{$kategori->kategori_id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class=" p-2 rounded-3xl hover:stroke-white hover:bg-red-400"
                                        onclick="return confirmDelete('{{$kategori->kategori_id}}')"><x-trash-icon></x-trash-icon></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    function confirmDelete(kategori_id) {
                        Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    // Submit the form after the SweetAlert is closed
                                    document.getElementById('deleteForm_'+kategori_id).submit();
                                });
                            }
                        });
                        // Return false to prevent the form from submitting automatically
                        return false;
                    }
                </script>
                <script>
                    function confirmAddCategory() {
                    Swal.fire({
                        title: "Add Category",
                        text: "Enter category name:",
                        icon: "question",
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Add Category",
                        cancelButtonText: "Cancel",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const categoryName = Swal.getPopup().querySelector('#swal2-input').value;
                            
                            if (!categoryName.trim()) {
                                Swal.fire("Error!", "Category name cannot be empty.", "error").then(() => {
                                    confirmAddCategory(); // Memanggil kembali sweet alert setelah menampilkan pesan error
                                });
                                return false; // Menghentikan eksekusi berikutnya
                            }
                            
                            document.getElementById('kategori').value = categoryName;
                            document.getElementById('addCategoryForm').submit();
                        }
                    });
                }
                </script>
                <script>
                    function confirmEditCategory(kategori_id, kategori) {
                    Swal.fire({
                        title: "Edit Category",
                        text: "Enter updated category name:",
                        icon: "question",
                        input: 'text',
                        inputValue: kategori,
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Edit Category",
                        cancelButtonText: "Cancel",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const updatedCategoryName = Swal.getPopup().querySelector('#swal2-input').value;
                            
                            if (!updatedCategoryName.trim()) {
                                Swal.fire("Error!", "Category name cannot be empty.", "error").then(() => {
                                    confirmEditCategory(kategori_id, kategori); // Memanggil kembali sweet alert setelah menampilkan pesan error
                                });
                                return false; // Menghentikan eksekusi berikutnya
                            }
                            
                            document.getElementById('updated_kategori').value = updatedCategoryName;
                            document.getElementById('editCategoryForm_' + kategori_id).submit();
                        }
                    });
                }
                </script>
            </div>

            <div class="p-2">
                {{ $kategories->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
