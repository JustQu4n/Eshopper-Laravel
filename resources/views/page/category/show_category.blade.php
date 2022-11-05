@extends('layout')
@section('sidebar')
<div class="left-sidebar">
	<h2>DANH MỤC</h2>
	
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		@foreach ($category_product as $key =>$cate_value)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a href="{{URL::to('/danh-muc-san-pham/'.$cate_value->category_id)}}">	{{$cate_value->category_name}}
					</a>
				</h4>
			</div>
		</div>
		@endforeach
	</div><!--/category-products-->
	
	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		@foreach ($brand_product as $key =>$brand_value)
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				
				<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand_value->brand_id)}}""> <span class="pull-right">(1)</span>{{$brand_value->brand_name}}</a></li>
	
			</ul>
		</div>
		@endforeach
	</div><!--/brands_products-->
	
	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
			 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div><!--/price-range-->
	
	<div class="shipping text-center"><!--shipping-->
		<img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
	</div><!--/shipping-->

</div>
@endsection
@section('content')
				<div class="features_items"><!--features_items-->
					@foreach ($category_title as $key => $cvalue)
					<h2 class="title text-center">{{$cvalue->category_name}}</h2>
					@endforeach
					@foreach ($category_by_id as $key =>$value)
					<a href="{{URL::to('chi-tiet-san-pham/'.$value->product_id)}}">
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{URL::to('public/upload/product/'.$value->product_image)}}" alt="">
										<h2>{{$value->product_name}}</h2>
										<p>{{number_format($value->product_price).' VND'}}</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
					</a>
				</div>
				
@endsection
