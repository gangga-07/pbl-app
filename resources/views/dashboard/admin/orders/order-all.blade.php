@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Order
    </h2>
    <div class="intro-y text-base mt-2 text-gray-600">
        Total {{ $order->total() }} orders
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="" class="btn btn-primary shadow-md mr-2">Cetak Data Order</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500"></div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">No.</th>
                        <th class="text-center whitespace-nowrap">PEMBELI</th>
                        <th class="text-center whitespace-nowrap">PRODUK</th>
                        <th class="text-center whitespace-nowrap">HARGA</th>
                        <th class="text-center whitespace-nowrap">TANGGAL</th>
                        <th class="text-center whitespace-nowrap">PEMBAYARAN</th>
                        <th class="text-center whitespace-nowrap">PENGIRIMAN</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order as $item)
                        <tr class="intro-x">
                            <td class="text-center w-40"> {{ $loop->iteration }} </td>
                            <td class="text-center w-40">{{ $item->pembeli }} </td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">Rp. {{ $item->price }}</td>
                            <td class="text-center">{{ $item->tanggal }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">
                                <div class="flex items-center">
                                    <span>{{ $item->status_pengiriman }}</span>
                                    <a class="flex items-center ml-3 toggle-icon" href="{{ route('status_pengiriman', ['order' => $item]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1 icon"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="hidden">{{ $item->users_id }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('manage_order.detail', ['order' => $item]) }}"> <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Detail </a>
                                    {{-- <a class="flex items-center mr-3" href="{{ route('manage_order.update', ['order' => $item]) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a> --}}
                                    <form method="POST" action="{{ route('manage_order.delete', ['order'=>$item]) }}">
                                        <button class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler({{$item}})"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Delete</button>
                                        @method('DELETE')
                                        {{ csrf_field() }} 
                                    </form>
                                </div>
                            </td>
                        </tr>   
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="8">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {{ $order->links() }} <!-- Menggunakan metode links() untuk menampilkan tautan paginasi -->
            </nav>
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records? 
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 flex justify-center items-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <form id="deleteItem" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="" id="delete_route_input">
                            <button type="submit" class="flex items-center btn btn-danger w-24 text-danger"><i
                                    data-lucide="trash-2"
                                    class="w-4 h-4 mr-1"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
   <script src="{{ asset('dist/js/view/manage-order/order.js') }}"></script> 
   <script>
    $(document).ready(function () {
        // Function to handle the click event for the icon
        $(".toggle-icon").on("click", function (e) {
            e.preventDefault();
            const icon = $(this).find(".icon");
            icon.addClass("text-red-500"); // Add the red color class
            setTimeout(function () {
                // Hapus elemen icon dari DOM setelah 1 detik
                icon.remove();
            }, 1000); // Adjust the delay time (in milliseconds) as needed
            // Anda dapat melakukan tindakan lain di sini jika diperlukan setelah mengklik.
            // Misalnya, Anda dapat menggunakan AJAX untuk melakukan beberapa operasi server-side.
        });
    });
</script>
@endsection
