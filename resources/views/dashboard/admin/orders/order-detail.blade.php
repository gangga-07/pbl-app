@extends('layouts.dashboard-layout')
@section('dashboard-content')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Detail Order
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box p-8">
                <div class="md:flex md:flex-row gap-5">
                    {{-- <div class="md:flex-shrink-0 basis-4/12 justify-center">              
                        <img class="featured-img" src="{{  asset($order->images->count() ? 'storage/' . $product->images->first()->src : 'dist/images/default.jpg') }}" alt="">
                        <div class="thumb-slide-wrapper mt-5 p-1">
                        </div>  
                    </div> --}}
                    <div class="md:flex-shrink-0 basis-8/12">
                        <div class="flex flex-row gap-2">
                            <label for="name" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Pembeli</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->pembeli }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="email" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Email</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->email }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="category" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Produk</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->name }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="no_tlp" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Telepon</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->no_tlp }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="tanggal" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Tanggal Pembelian</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ date('l, d F Y', strtotime($order->tanggal)) }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="price" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Harga</label>
                            <p class="basis-2/3 text-sm mb-2">: Rp. {{ $order->price }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="status" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Status Pembayaran</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->status }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="status" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Status Pengiriman Produk</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $order->status_pengiriman }}</p>
                        </div>
                        {{-- <div>
                            <form action="{{ route('send_invoice', $order->id) }}" method="POST">
                                @csrf
                                <div class="hidden">
                                    <input type="email" name="recipient_email" value="{{ $order->email }}" id="">
                                </div>
                                <input type="submit" value="Kirim Invoice">
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
<script>
    jQuery(document).ready(function () {
    productImages();
});
</script>
@endsection