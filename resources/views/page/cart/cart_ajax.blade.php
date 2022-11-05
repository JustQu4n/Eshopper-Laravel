<div class="table-responsive cart_info">
				
    <table class="table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image">Hình ảnh</td>
                <td class="description">Tên sản phẩm</td>
                <td class="price">Giá sản phẩm</td>
                <td class="quantity">Số lượng</td>
                <td class="total">Thành tiền</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
                
            @php
                    $total = 0;
            @endphp
            @foreach(Session::get('cart') as $key => $cart)
                @php
                    $subtotal = $cart['product_price']*$cart['product_qty'];
                    $total+=$subtotal;
                @endphp

            <tr>
                <td class="cart_product">
                    <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                </td>
                <td class="cart_description">
                    <h4><a href=""></a></h4>
                    <p>{{$cart['product_name']}}</p>
                </td>
                <td class="cart_price">
                    <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
                </td>
                <td class="cart_quantity">
                    <div class="cart_quantity_button">
                        <form action="" method="POST">
                    
                        <input class="cart_quantity_" type="number" min="1" name="cart_quantity" value="{{$cart['product_qty']}}"  >
                    
                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                        </form>
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">
                        {{number_format($subtotal,0,',','.')}}đ
                        
                    </p>
                </td>
                <td class="cart_delete">
                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>