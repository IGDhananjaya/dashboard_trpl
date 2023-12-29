<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
 
 @if (session()->has('success'))
     <div id="successAlert"
         class="flex items-center p-4  text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 m-5 max-w-sm mx-auto my-auto"
         role="alert">
         <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 20 20">
             <path
                 d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
         </svg>
         <span class="sr-only">Info</span>
         <div>
             <span class="font-medium">Success alert!</span> {{ session('success') }}
         </div>
     </div>
 @endif

 {{-- @if (session()->has('success'))
    <div id="successAlert" class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 m-5 max-w-sm mx-auto my-auto" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Success alert!</span> {{ session('success') }}
        </div>
    </div> --}}

 <script>
     const successAlert = document.getElementById('successAlert');
     if (successAlert) {
         setTimeout(function() {
             successAlert.style.display = 'none';
         }, 2000); //dalam satuan milidetik
        }

    // document.addEventListener('DOMContentLoaded', function () {
    //         Swal.fire({
    //             position: "top-end",
    //             icon: "success",
    //             title: "Your work has been saved",
    //             showConfirmButton: false,
    //             timer: 1500
    //         });
    //     });
 </script>
