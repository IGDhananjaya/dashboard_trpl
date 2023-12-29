<x-app-layout>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
    </head>
    <div class="p-4 sm:ml-64">
        <form class="mb-4" action="/dashboard/berita">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                {{-- <select name="id_category" id="id_category" class="block w-full py-2 px-4 border-gray-300 bg-white rounded-l-2x1 shadow-sm focus:outline-none">
                    <option value="">Choose Category</option>
                    @foreach ($kategories as $item)
                        <option value="{{$item->kategori_id}}" {{(isset($_get['kategori_id'])&&$_get['kategori_id']==$item->kategori_id)?'selected':''}}>{{$item->kategori}}</option>
                    @endforeach
                </select> --}}
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-search-icon></x-search-icon>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search" name="search" value="{{ request('search') }}">
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <x-button-add class="mb-4"></x-button-add>
            <div class="">
                <x-alert-succes></x-alert-succes>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="min-w-full table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">#</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                Judul
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                        @foreach ($beritas as $berita)
                            <x-list-post :iteration="$loop->iteration" :berita="$berita"></x-list-post>
                        @endforeach
                        {{-- @foreach ($beritas as $berita)
                            @php
                                $nomor_item = $loop->iteration + $beritas->firstItem() - 1;
                            @endphp

                            <x-list-post :iteration="$nomor_item" :berita="$berita"></x-list-post>
                        @endforeach --}}
                    </tbody>
                </table>

                <script>
                    function confirmDelete(slug) {
                        // Swal.fire({
                        //     title: "Are you sure?",
                        //     text: "You won't be able to revert this!",
                        //     icon: "warning",
                        //     showCancelButton: true,
                        //     confirmButtonText: "Yes, delete it!",
                        //     cancelButtonText: "No, cancel",
                        //     reverseButtons: true
                        // }).then((result) => {
                        //     if (result.isConfirmed) {
                        //         Swal.fire({
                        //             title: "Deleted!",
                        //             text: "Your file has been deleted.",
                        //             icon: "success"
                        //         }).then(() => {
                        //             // Submit the form after the SweetAlert is closed
                        //             document.getElementById('deleteForm').submit();
                        //         });
                        //     } else if (result.dismiss === Swal.DismissReason.cancel) {
                        //         Swal.fire({
                        //             title: "Cancelled",
                        //             text: "Your imaginary file is safe :)",
                        //             icon: "error"
                        //         });
                        //     }
                        // });
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
                                    document.getElementById('deleteForm_'+slug).submit();
                                });
                            }
                        });
                        // Return false to prevent the form from submitting automatically
                        return false;
                    }
                </script>
            </div>

            <div class="p-2">
                {{ $beritas->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
