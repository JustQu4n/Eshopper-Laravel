@extends('layout')
@section('sidebar')
<div class="left-sidebar">
	<h2>DANH MỤC</h2>
	
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		@foreach ($categories as $key =>$cate_value)
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
		@foreach ($brand as $key =>$brand_value)
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
@foreach ($detail_product as $key => $value)
<div class="product-details"><!--product-details-->

    <div class="col-sm-5">
     
        <div class="view-product">
            <img src="{{asset('public/upload/product/'.$value->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
   
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
        
            <h1>{{$value->product_name}}</h1>
            <p>Web ID: {{$value->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
                <form action="{{URL::to('save-cart')}}" method="POST">
                    {{ csrf_field() }}
            <span>
                <span>{{number_format($value->product_price)}} VND</span>
                <label>Số lượng :</label>
                <input type="number" name="qty" min="1" value="1" />
                <input name="productid_hidden" type="hidden" value="{{$value->product_id}}">
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                   Thêm vào giỏ
                </button>
            </span>
             </form>
            <h4><b>Availability: </b> In Stock</h4>
            <h4><b>Condition: </b> New</h4>
            <h4><b>Brand: </b>{{$value->brand_name}}</h4>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
          
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Reviews</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Details</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade  in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
            
           
        </div>
        <div class="tab-pane fade in " id="details"  >
            <div class="col-sm-3">
                <h5>{{$value->product_content}}</h5>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">SAN PHAM LIEN QUAN</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($related_product as $key => $value_related)
                <a href="{{URL::to('chi-tiet-san-pham/'.$value_related->product_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('public/upload/product/'.$value_related->product_image)}}" alt="" />
                                <h5>{{$value_related->product_name}}</h5>
                                <p>{{number_format($value_related->product_price)}} VND</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                @endforeach	
            </div>
        </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>			
    </div>
</div><!--/recommended_items-->


@endsection