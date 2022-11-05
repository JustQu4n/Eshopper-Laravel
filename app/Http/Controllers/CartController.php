<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
//   public function add_cart_ajax(Request $request){
//     $data = $request->all();
//     $session_id = substr(md5(microtime()),rand(0,26),5);
//     $cart = Session::get('cart');
//     if($cart==true){
//         $is_avaiable = 0;
//         foreach($cart as $key => $val){
//             if($val['product_id']==$data['cart_product_id']){
//                 $is_avaiable++;
//             }
//         }
//         if($is_avaiable == 0){
//             $cart[] = array(
//             'session_id' => $session_id,
//             'product_name' => $data['cart_product_name'],
//             'product_id' => $data['cart_product_id'],
//             'product_image' => $data['cart_product_image'],
//             'product_qty' => $data['cart_product_qty'],
//             'product_price' => $data['cart_product_price'],
//             );
//             Session::put('cart',$cart);
//         }
//     }else{
//         $cart[] = array(
//             'session_id' => $session_id,
//             'product_name' => $data['cart_product_name'],
//             'product_id' => $data['cart_product_id'],
//             'product_image' => $data['cart_product_image'],
//             'product_qty' => $data['cart_product_qty'],
//             'product_price' => $data['cart_product_price'],

//         );
//         Session::put('cart',$cart);
//     }
   
//     Session::save();

// }  
// public function gio_hang(Request $request){
//   $meta_desc = "gio hang cua ban";
//   $meta_keywords = " Gio hang ajax";
//   $meta_title = "Gio hang ajax";
//   $url_canonical = $request->url();
//   $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
//   $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
//   return view('page.cart.cart_ajax')->with('categories',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
// }
   public function save_cart(Request $request){
    
     $productId = $request->productid_hidden;
    
     $quantity = $request->qty;
     $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

    $data['id'] = $product_info->product_id;
    $data['qty'] = $quantity;
    $data['name'] = $product_info->product_name;
    $data['price'] = $product_info->product_price;
    $data['weight'] = "123";
    $data['options']['image'] = $product_info->product_image;
    Cart::add($data);
   return Redirect::to('/show-cart');
     
       
   }
   public function show_cart(){
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    return view('page.cart.show-cart')->with('categories',$cate_product)->with('brand',$brand_product);
   }
}
