<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandController extends Controller

{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
             return Redirect::to('admin.dashboard');
        }else{
          return Redirect::to('admin_login');
        }
      }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add-brand-product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product=  DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all-brand-product')->with('all_brand_product',$all_brand_product);
         return view('admin_layout')->with('admin.all-brand-product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_descript;
        $data['brand_status'] = $request->brand_product_status;

    
         DB::table('tbl_brand_product')->insert($data);
         Session::put('message', 'Successfully');
         return Redirect::to('/all-brand-product');
     
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
       Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
        return Redirect::to('all-brand-product');
     } 
     public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
       Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
        return Redirect::to('all-brand-product');
     }
     
public function edit_brand_product($brand_product_id){
    $this->AuthLogin();
    $edit_brand_product =DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
    $manager_brand_product = view('admin.edit-brand-product')->with('edit_brand_product',$edit_brand_product);
    return view('admin_layout')->with('admin.edit-brand-product',$manager_brand_product);
}
public function update_brand_product(Request $request,$brand_product_id){
    $this->AuthLogin();
    $data = array();
    $data['brand_name'] = $request->brand_product_name;
    $data['brand_desc'] = $request->brand_product_descript;
    DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);
    Session::put('message','Cap nhat sản phẩm thành công!');
    return Redirect::to('all-brand-product');

}
public function delete_brand_product($brand_product_id){
    $this->AuthLogin();
    DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
    Session::put('message','Xoa sản phẩm thành công!');
    return Redirect::to('all-brand-product');

}
public function show_brand_home($brand_id) {
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
 $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    $brand_by_id = DB::table('tbl_product')
    ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
    ->where('tbl_product.brand_id',$brand_id)
    ->get();
    $brand_title_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();
return view('page.brand.show_brand')
->with('brand_product', $brand_product)
->with('category_product', $cate_product)
->with('brand_by_id', $brand_by_id)
->with('brand_title_name', $brand_title_name);
}

}
