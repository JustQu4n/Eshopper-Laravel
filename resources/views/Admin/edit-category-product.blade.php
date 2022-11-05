@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $item)
                    <div class="position-center">
                        <form role="form" method="post" action="{{URL::to('/update-category-product/'.$item->category_id)}}">
                            {{ csrf_field() }}
                           
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_product_name"  value="{{$item->category_name}}" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea type="password" class="form-control" name="category_product_descript" >{{$item->category_description}}</textarea>
                        </div>
                        @endforeach
                        <button type="submit" name="add-category-product"class="btn btn-info">Cập nhật</button>
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