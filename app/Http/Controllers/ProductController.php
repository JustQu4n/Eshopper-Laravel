<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function add_product(){
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
      return view('admin.add-product')->with('brand_product', $brand_product)->with('cate_product', $cate_product);
    }
    
    public function all_product(){
        $all_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')
        ->get();
        $manager_product = view('admin.all-product')->with('all_product',$all_product);
         return view('admin_layout')->with('admin.all-product',$manager_product);
    }
    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_descript;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $get_img = $request->file('product_image');
       
        if ($get_img) {
            $get_name_image =$get_img->getClientOriginalName();
            $name_img= current(explode(',',$get_name_image));
            $new_image = $name_img;
            $get_img->move('public/upload/product/',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Successfully');
            return Redirect::to('/all-product');
        }
        $data['product_image']= '';
         DB::table('tbl_product')->insert($data);
         Session::put('message', 'Successfully');
         return Redirect::to('/all-product');
     
    }
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
       Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
        return Redirect::to('all-product');
     } 
     public function active_product($product_id){
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
       Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
        return Redirect::to('all-product');
     }
     
public function edit_product($product_id){
    $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();

    $edit_product =DB::table('tbl_product')->where('product_id', $product_id)->get();
    $manager_product = view('admin.edit-product')
    ->with('edit_product',$edit_product)
    ->with('cate_product', $cate_product)
    ->with('brand_product', $brand_product);

    return view('admin_layout')->with('admin.edit-product',$manager_product);
}
public function update_product(Request $request,$product_id){
    $data = array();
    $data['product_name'] = $request->product_name;
    $data['product_desc'] = $request->product_descript;
    $data['product_price'] = $request->product_price;
    $data['product_content'] = $request->product_content;
    $data['product_status'] = $request->product_status;
    $data['category_id'] = $request->product_cate;
    $data['brand_id'] = $request->product_brand;
    $get_img = $request->file('product_image');
    if ($get_img) {
        $get_name_image =$get_img->getClientOriginalName();
        $name_img= current(explode(',',$get_name_image));
        $new_image = $name_img;
        $get_img->move('public/upload/product/',$new_image);
        $data['product_image']= $new_image;
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message','Cap nhat sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    DB::table('tbl_product')->where('product_id', $product_id)->update($data);
    Session::put('message','Cap nhat sản phẩm thành công!');
    return Redirect::to('all-product');

}
public function delete_product($product_id){
    DB::table('tbl_product')->where('product_id', $product_id)->delete();
    Session::put('message','Xoa sản phẩm thành công!');
    return Redirect::to('all-product');

}
//END -HOME-PAGE

public function detail_product($product_id){
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    $detail_product = DB::table('tbl_product')
    ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
    ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
    ->where('tbl_product.product_id',$product_id)->get();
   
    foreach($detail_product as $key => $value) {
        $category_id = $value->category_id;
    }
    $related_product = DB::table('tbl_product')
    ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
    ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
    ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
    return view('page.sanpham.detail-product')->with('categories',$cate_product)->with('brand',$brand_product)->with('detail_product',$detail_product)->with('related_product',$related_product);
}
}

