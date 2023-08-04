<header>
    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <a class="logo" href="#">
                        <img src="{{asset('style/img/logo.jpg')}}" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Search -->
                {{-- <div class="header-search"> --}}
                    {{-- <form action="{{ route('manage_product.store') }}" method="POST" enctype="multipart/form-data"> --}}
                        {{-- <input class="input search-input" type="text" placeholder="Enter your keyword"> --}}
                        {{-- <select class="input search-categories">
                            <option value="0">All Categories</option>
                            <option value="1">Category 01</option>
                            <option value="1">Category 02</option>
                        </select> --}}
                        {{-- <select class="input search-categories" name="category_id" id="category_id" data-placeholder="Choose Product Category"
                                class="tom-select w-full">
                                <option value="0">Categories</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id')==$item->id?'selected':null }}>{{ $item->name }}</option>
                                @endforeach
                            </select> --}}
                        
                        {{-- <button class="search-btn"><i class="fa fa-search"></i></button> --}}
                    {{-- </form> --}}
                {{-- </div> --}}
                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                                
                            </div>
                            <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                        </div>
                        {{-- <a href="#" class="text-uppercase">Login</a> / <a href="#" class="text-uppercase">Join</a> --}}
                        <a href="#" class="text-uppercase">{{ auth()->user()->name ??'Username'}}</a>
                        <ul class="custom-menu">
                            {{-- <li><a href="#"><i class="fa fa-user-o"></i> {{ auth()->user()->name ??'Username'}}</a></li> --}}
                            @if ($role_id = Auth::user())
                            <li><a href="{{ route('my-account') }}"><i class="fa fa-user-o"></i> My Account</a></li>
                            <li><a href="{{ route('allWhislist') }}"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
                            {{-- <li><a href="{{ route('cartall') }}"><i class="fa fa-shopping-cart"></i> My Cartlist</a></li> --}}
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
  
                            @else
                           
                            <li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
                            <li><a href="{{ route('login') }}"><i class="fa fa-unlock-alt"></i> Login</a></li>
                            <li><a href="{{ route('attempt_register') }}"><i class="fa fa-user-plus"></i> Create An Account</a></li>
                            @endif
                        </ul>
                    </li>
                    <!-- /Account -->

                    <!-- Cart -->
                    <li class="header-cart dropdown default-dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="cart-qty" class="qty">0</span>
                            </div>
                            <strong class="text-uppercase">My Cart:</strong>
                            <br>
                        </a>
                        
                        <div class="custom-menu">
                            <div id="shopping-cart">
                                <div class="shopping-cart-list">
                                    {{-- <div class="product product-widget">
                                        <div class="product-thumb">
                                            <img src="style/img/thumb-product01.jpg" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
                                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        </div>
                                        <button class="cancel-btn"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="product product-widget">
                                        <div class="product-thumb">
                                            <img src="style/img/thumb-product01.jpg" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
                                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        </div>
                                        <button class="cancel-btn"><i class="fa fa-trash"></i></button>
                                    </div> --}}
                                </div>
                                <div class="shopping-cart-btns">
                                    <button class="main-btn"> <a href="{{ route('cartall') }}">View Cart</a></button>
                                    <button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /Cart -->

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>

{{-- JAVASCRIPT UNTUK UPDATE JUMLAH DATA CART SESUAI DATABASE --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        updateCartQty();

        function updateCartQty() {
            $.ajax({
                url: '/cart-qty', // Ganti dengan URL yang sesuai untuk mengambil jumlah data di tabel cart
                method: 'GET',
                success: function(response) {
                    $('#cart-qty').text(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });
</script>