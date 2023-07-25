@extends('layouts.dashboard-layout')

@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">
        My Wishlist
    </h2>
    <ul class="breadcrumb mt-2">
        <li><a href="{{ route('main') }}"><i class="fa fa-home mr-1"></i></a></li>
        <li>
            <p>Home</p>
        </li>
    </ul>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">No.</th>
                        <th class="text-center whitespace-nowrap">Image</th>
                        <th class="text-center whitespace-nowrap">Product Name</th>
                        <th class="text-center whitespace-nowrap">Unit Price</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($whislist as $index => $item)
                        <tr class="intro-x" id="row-{{ $index }}">
                            <td class="text-center w-20">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <a href="product.html">
                                    <img width="70px" src="{{ asset($item->product->images->count() ? 'storage/' . $item->product->images->first()->src : '/image/catalog/demo/product/80/2.jpg') }}" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop">
                                </a>
                            </td>
                            <td class="text-center">{{ $item->product->name }}</td>
                            <td class="text-center">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <form method="POST" action="{{ route('manage_whislist.delete',['whislist'=>$item]) }}">
                                        <button class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler({{ $item->id }})">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Delete
                                        </button>
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="9">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <!-- Pagination Links Here -->
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
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
                            Do you really want to delete this record?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 flex justify-center items-center">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="flex items-center btn btn-danger w-24 text-danger" id="delete-confirm-btn"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
<script>
    function deleteModalHandler(id) {
        var deleteUrl = "{{ route('manage_cart.delete', ['cart' => ':cartId']) }}";
        deleteUrl = deleteUrl.replace(':cartId', id);
        $('#delete_route_input').val(deleteUrl);
    }

    $(document).ready(function() {
        $('#delete-confirm-btn').click(function() {
            var deleteUrl = $('#delete_route_input').val();

            // Tampilkan konfirmasi hapus menggunakan SweetAlert
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan hapus menggunakan AJAX
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Sukses', response.message, 'success');
                            // Hapus baris tabel dari HTML setelah berhasil menghapus data
                            $('#row-' + id).remove();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    // Batalkan aksi hapus
                    Swal.fire('Dibatalkan', 'Aksi hapus dibatalkan', 'info');
                }
            });

            $('#delete-confirmation-modal').modal('hide');
        });
    });
</script>
@endsection
