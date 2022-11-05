@extends('admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                 Thêm thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post" action="{{URL::to('/save-brand-product')}}">
                            {{ csrf_field() }}
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Tên thương hiệu </label>
                            <input type="text" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea type="password" class="form-control" name="brand_product_descript" id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="brand_product_status" class="form-control input-lg m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện thị</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="add-brand-product"class="btn btn-info">Thêm</button>
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