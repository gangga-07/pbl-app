
{{-- {{ dd($product->toArray()) }} --}}
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
@include('frontpage/menu-nav')
	<!-- /NAVIGATION -->


	<!-- section -->
	{{-- <div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="style/img/banner10.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="style/img/banner11.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
					<a class="banner banner-1" href="#">
						<img src="style/img/banner12.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div> --}}
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section-title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Deals Of The Product</h2>
						<div class="pull-right">
							<div class="product-slick-dots-1 custom-dots"></div>
						</div>
					</div>
				</div>
				<!-- /section-title -->

				<!-- banner -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<img src="style/img/baner1.jpg" alt="">
						<div class="banner-caption">
							{{-- <h2 class="white-color">NEW<br>COLLECTION</h2> --}}
							{{-- <button class="primary-btn">Shop Now</button> --}}
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- Product Slick -->
				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-1" class="product-slick">
							@foreach ($product as $item)		
							<div class="product product-single">
								<div class="product-thumb">
									{{-- <div class="product-label">
										<span>New</span>
										<span class="sale">-20%</span>
									</div>
									 --}}
									<a class="main-btn quick-view"><i class="fa fa-search-plus" ></i> Quick view</a>
									{{-- <img src="style/img/image.jpg" alt=""> --}}
									<img class="featured-img" src="{{asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/default.jpg') }}" alt="">
								</div>	
								<div class="product-body">
									{{-- <h3 class="product-price">Rp 500.000 <del class="product-old-price">Rp 1.000.000</del></h3> --}}
									<h3 class="product-price">Rp. {{number_format($item->price,0,",",".")}}</h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<p class="product-name">{{ $item->name }}</p>
									<div class="product-btns">
										<a href="{{ route('whislist', ['product_id' => $item->id]) }}"><button class="main-btn icon-btn"><i class="fa fa-heart"></i></button></a>
										<a class="main-btn icon-btn" href="{{ route('product-detail', ['product' => $item]) }}"><i class="fa fa-eye"></i></a>
										<a class="main-btn icon-btn" href="{{ route('cartlist', ['product_id' => $item->id]) }}"><i class="fa fa-shopping-cart"></i></a>
										{{-- <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
										<a class="primary-btn add-to-cart" href="{{ url('detail-cart/'.$item->product_code) }}"><i class=""></i> Checkout</a>
										{{-- <a class="primary-btn add-to-cart" href="{{ route('manage_product.detail', ['product' => $item]) }}"> <i data-lucide="eye" class="fa fa-shopping-cart"></i> Detail </a> --}}
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->

			{{-- BAGIAN 3(BLOK 3) --}}
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Deals Of The Day</h2>
						<div class="pull-right">
							<div class="product-slick-dots-2 custom-dots">
							</div>
						</div>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single product-hot">
						<div class="product-thumb">
							{{-- <div class="product-label">
								<span class="sale">-20%</span>
							</div>
							<ul class="product-countdown">
								<li><span>00 H</span></li>
								<li><span>00 M</span></li>
								<li><span>00 S</span></li>
							</ul> --}}
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<img src="style/img/image.jpg" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">Rp 500.000 <del class="product-old-price">Rp 1.000.000</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->

				<!-- Product Slick BAGIAN 2 -->
				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-2" class="product-slick">
							<!-- Product Single 1 -->
						
								@foreach ($product as $item)		
							<div class="product product-single">
								<div class="product-thumb">
									{{-- <div class="product-label">
										<span>New</span>
										<span class="sale">-20%</span>
									</div>
									 --}}
									<a class="main-btn quick-view"><i class="fa fa-search-plus" ></i> Quick view</a>
									{{-- <img src="style/img/image.jpg" alt=""> --}}
									<img class="featured-img" src="{{asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/default.jpg') }}" alt="">
								</div>	
								<div class="product-body">
									{{-- <h3 class="product-price">Rp 500.000 <del class="product-old-price">Rp 1.000.000</del></h3> --}}
									<h3 class="product-price">Rp. {{number_format($item->price,0,",",".")}}</h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<p class="product-name">{{ $item->name }}</p>
									{{-- <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2> --}}
									<div class="product-btns">
										<a class="main-btn icon-btn" href="{{ route('whislist', ['product_id' => $item->id]) }}"><i class="fa fa-heart"></i></a>
										<a class="main-btn icon-btn" href="{{ route('product-detail', ['product' => $item]) }}"><i class="fa fa-eye"></i></a>
										<a class="main-btn icon-btn" href="{{ route('cartlist', ['product_id' => $item->id]) }}"><i class="fa fa-shopping-cart"></i></a>
										<a class="primary-btn add-to-cart" href="{{ url('detail-cart/'.$item->product_code) }}"><i class=""></i> Checkout</a>
										{{-- <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart </button> --}}
									
										{{-- <a class="primary-btn add-to-cart" href="{{ route('whislist', ['product' => $item]) }}"> <i data-lucide="eye" class="fa fa-shopping-cart"></i> Detail </a> --}}
									</div>
								</div>
							</div>
							@endforeach
							
							<!-- /Product Single -->

							<!-- Product Single 2 -->
							{{-- <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span class="sale">-20%</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
									<img src="style/img/image.jpg" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">Rp 1.000.000 <del class="product-old-price">Rp 2.000.000</del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div> --}}
							<!-- /Product Single -->

							<!-- Product Single 3 -->
							{{-- <div class="product product-single">
								<div class="product-thumb">
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
									<img src="style/img/image.jpg" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">Rp 2.000.000</h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div> --}}
							<!-- /Product Single -->

							<!-- Product Single 4 -->
							{{-- <div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
										<span class="sale">-50%</span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
									<img src="style/img/image.jpg" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">Rp 1.000.000 <del class="product-old-price">Rp 2.000.000</del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div> --}}
							<!-- /Product Single -->

						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	{{-- BANNER 4 (GAMBAR BLOK 4) --}}
	<!-- section -->
	<div class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<img src="style/img/image.jpg" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="style/img/image.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW PROGRAMS</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="style/img/image.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW APPLICATION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

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
