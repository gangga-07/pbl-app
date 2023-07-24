<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontpage/link')
</head>
<body>
	<style>
		*
		{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: Arial, Helvetica, sans-serif;
		}
		
		body				
		.badan
		{
			width: 880px;
			margin: 30px auto;
			background-color: white;
			/* padding: 80px; */
			overflow: hidden;
		}
		
		.badan h2
		{
			color: black;
			border-bottom: 1px solid gainsboro;
			margin: 5px;
			margin-bottom: 13px;
			-webkit-transition: 0.3s all;
			transition: 0.3s all;
		}
		
		.list-produk
		{
			border: 1px solid gainsboro;
			padding: 10px;
			float: left;
			width: 350px;
			margin: 5px;
		}
		
		.list-produk:hover
		{
			transition-duration: 700ms;
			box-shadow: 5px 5px gainsboro;
		}
		
		.list-produk img
		{
			width: 100%;
			height: 175px;
			display: block;
			margin-bottom: 5px;
		}
		
		.list-produk h4, .list-produk h5
		{
			color: black;
			text-align: left;
			margin-bottom: 5px;
		}
		.list-produk, .list-rating i{
			color: gold;
		}
</style>

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
						<li><a href="{{Route('product.all')}}">Product</a></li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside widget -->
				<div class="aside">
					<h3 class="aside-title">Cara Order:</h3>
					<p> 1. Login/ registrasi member</p>
					<p>	2. Pilih program, klik tombol Bungkus</p>
					<p>	3. Klik tombol Checkout</p>
					<p>	4. Klik tombol Selesai</p>
				</div>
				<!-- /aside widget -->

				<!-- aside widget -->
				<div class="aside">
					<h3 class="aside-title">Filter by Category</h3>
					<ul class="list-links">
						<li><a href="{{Route('ecommerce.cat')}}">Ecommerce website</a></li>
                    <li><a href="{{Route('business.cat')}}">Business website</a></li>
					</ul>
				</div>
				<!-- /aside widget -->
			</div>
			<!-- /ASIDE -->
			<!-- MAIN -->
			<div id="main" class="col-md-9">
				<!-- STORE -->
		<!-- row -->
					<div class="row">
						<!-- Product Single -->
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="badan">
								@foreach ($product as $item)	
								<div class="list-produk">
									<img class="featured-img" src="{{asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/default.jpg') }}" alt=""> 
									<h4 class="product-price">Rp. {{number_format($item->price,0,",",".")}}</h4>
									<h5 class="product-name">{{ $item->name }}</h5>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<div class="product-btns">
										<a class="main-btn icon-btn" href="{{ route('product-detail', ['product' => $item]) }}"><i class="fa fa-eye"></i></a>
										<a class="main-btn icon-btn" href="{{ route('whislist', ['product_id' => $item->id]) }}"><i class="fa fa-heart"></i></a>
										<a class="main-btn icon-btn" href="{{ route('cartlist', ['product_id' => $item->id]) }}"><i class="fa fa-cart-plus"></i></a>
										<a class="primary-btn add-to-cart" href="{{ url('detail-cart/'.$item->product_code) }}"><i class=""></i> Checkout</a>
									</div>
								</div>
								@endforeach
							</div>
						<!-- /Product Single -->
						</div>
					</div>
			</div>
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



        {{-- <div class="list-produk">
            <img src="gambar/jaket-naruto.jpg" alt="Jaket Naruto">
 
            <h4>Jaket Naruto</h4>
            <h5>Rp 170.000,-</h5>
 
            <a class="tombol tombol-detail" href="#">Detail</a>
            <a class="tombol tombol-beli" href="#">Beli</a>
		</div>  --}}