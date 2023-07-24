{{-- {{dd($name)}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontpage/link')
</head>

<body>
    <!-- HEADER -->
    @include('frontpage/header')

    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                <!-- category nav -->
                <div class="category-nav show-on-click">
                    <span class="category-header">Categories <i class="fa fa-list"></i></span>

                </div>
                <!-- /category nav -->

                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="#">Product</a></li>
                    </ul>
                </div>
                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->

    <div class="res layout-1 layout-subpage">
        <div id="wrapper" class="wrapper-fluid banners-effect-5">
            {{-- @include('frontpage.frontpage-navbar') --}}
            <!-- Main Container  -->
            <div class="main-container container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('main') }}"><i class="fa fa-home"></i></a></li>
                    <li>
                        <p>Home</p>
                    </li>
                </ul>

                <div class="row">
                    <!-- Middle Part Start -->
                    <div id="content" class="col-sm-9">
                        <h2 class="title">My Cart List</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <!-- Tabel Konten -->
                                <thead>
                                    <tr>
                                        <td class="text-center">Image</td>
                                        <td class="text-center">Product Name</td>
                                        <td class="text-center">Unit Price</td>
                                        <td class="text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="wishlist-body-to-identify">
                                    <!-- Isi Tabel -->
                                    @if (auth()->user())
                                    @forelse ($cart as $item)
                                        <tr data-product_code="{{ $item->product_code }}">
                                            <td class="text-center">
                                                <a href="product.html">
                                                    <img width="70px"
                                                        src="{{ asset($item->product->images->count() ? 'storage/' . $item->product->images->first()->src : '/image/catalog/demo/product/80/2.jpg') }}"
                                                        alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop">
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                <a href="#">{{ $item->product->name }}</a>
                                            </td>
                
                                            <td class="text-left">
                                                <div class="price">
                                                    Rp. {{ number_format($item->product->price,0,",",".") }}</div>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex justify-center items-center">
                                                    <form action="{{ route('manage_cart.delete',['cart'=>$item]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="flex items-center mr-3" title="Delete">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Product Here</td>
                                        </tr>
                                    @endforelse
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Login First To Open Wishlist</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <!-- Baris untuk menampilkan jumlah total harga -->
                                <tr>
                                    {{-- <td colspan="2"></td> --}}
                                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                    <td class="text-center">
                                        <strong>Rp.</strong>
                                    </td>
                                </tr>
                                <!-- Tombol "Bayar" dan "Belanja Lagi" -->
                                <tr>
                                    <td colspan="4" class="text-right">
                                        <a href="{{Route('product.all')}}" class="btn btn-success">Belanja Lagi</a>
                                        <a href="{{ url('detail-cart/'.$item->product_code) }}" class="btn btn-primary">Bayar</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Middle Part End -->
                </div>
                             
            </div>
            <!-- //Main Container -->
        </div>
    </div>

    <!-- FOOTER -->
    @include('frontpage/footer')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{asset('style/js/jquery.min.js')}}"></script>
    <script src="{{asset('style/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('style/js/slick.min.js')}}"></script>
    <script src="{{asset('style/js/nouislider.min.js')}}"></script>
    <script src="{{asset('style/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('style/js/main.js')}}"></script>

</body>

</html>