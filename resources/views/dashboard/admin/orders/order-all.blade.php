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
            {{-- <a href="" class="btn btn-primary shadow-md mr-2">Cetak Data Order</a> --}}
            <form method="GET" id="filterForm">
                <select class="btn btn-primary shadow-md mr-2" name="bulan" id="bulan">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                    <input type="text" name="tahun" id="tahun" placeholder="Input Tahun">
                    <button type="submit" class="btn btn-primary shadow-md ml-2 bg-green-500" target="_blank">Cetak Data Order</button>
                </form>
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
                        <td class="text-center">{{ date('d F Y', strtotime($item->tanggal)) }}</td>
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
    <!-- ... Konten lainnya -->
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

<!-- Tambahkan script JavaScript untuk cetak laporan -->
<script>
    // Tangkap elemen form
    const filterForm = document.getElementById('filterForm');

    // Tangkap elemen select bulan dan tahun
    const bulanSelect = document.getElementById('bulan');
    const tahunInput = document.getElementById('tahun');

    // Tambahkan event listener untuk mengirimkan permintaan cetak laporan
    filterForm.addEventListener('submit', function(event) {
    event.preventDefault();

    // Ambil nilai bulan dan tahun yang dipilih
    const bulan = bulanSelect.value;
    const tahun = tahunInput.value;

    // Kirim permintaan cetak laporan dengan parameter bulan dan tahun
    window.open('{{ route('cetakLaporanOrder', ['tahun' => 'tahun_value', 'bulan' => 'bulan_value']) }}'
        .replace('tahun_value', tahun)
        .replace('bulan_value', bulan), '_blank');
});
</script>
@endsection
