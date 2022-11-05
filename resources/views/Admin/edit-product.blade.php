@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Cập nhật Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($edit_product as $key => $item)
                        <form role="form" method="post" action="{{URL::to('/update-product/'.$item->product_id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Tên sản phẩm </label>
                            <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" value="{{$item->product_name}}">
                        </div>
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" value="{{$item->product_image}}">
                            <img src="{{URL::to('public/upload/product/'.$item->product_image)}}" alt="" width="100" height="100">
                        </div>
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="text" class="form-control" name="product_price" id="exampleInputEmail1"value="{{$item->product_price}}">
                        </div>
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Nội dung sản phẩm</label>
                            <input type="text" class="form-control" name="product_content" id="exampleInputEmail1" value="{{$item->product_content}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="product_descript" id="exampleInputPassword1" >{{$item->product_desc}}</textarea>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục</label>
                            <select name="product_cate" class="form-control input-lg m-bot15">
                                @foreach ($cate_product as $item => $cate_value)
                                <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                @endforeach 
                      
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control input-lg m-bot15">
                                @foreach ($brand_product as $item => $value) 
                                <option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-lg m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện thị</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="add-product"class="btn btn-info">Cập nhật</button>
                    </form>
                    <div class="tb" style=" with:100%; height:auto; backgound-color:#ddede0">
                        <?php 
                         $message = Session::get('message');
                      if ($message){
                           echo '<p style="color:rgb(75, 226, 75)"> '. $message.'</p>';
                           $message = Session::put('message',null);
                      }    
                        ?>  
                    </div>
                    </div>

                </div>
            </section>

    </div>
 </div>
 @endsection


