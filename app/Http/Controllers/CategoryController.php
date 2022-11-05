<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


session_start();

class CategoryController extends Controller
{
public function AuthLogin(){
       $admin_id = Session::get('admin_id');
       if($admin_id){
              return Redirect::to('admin.dashboard');
       }else{
              return Redirect::to('admin_login');
       }
       }
  public function add_category_product(){
       $this->AuthLogin();
         return view('admin.add-category-product');
  }
  public function all_category_product(){
       $this->AuthLogin();
  $all_category_product=  DB::table('tbl_category_product')->get();
  $manager_category_product = view('admin.all-category-product')->with('all_category_product',$all_category_product);
   return view('admin_layout')->with('admin.all-category-product',$manager_category_product);
}
public function save_category_product(Request $request){
       $this->AuthLogin();
    $data = array();
    $data['category_name'] = $request->category_product_name;
    $data['category_description'] = $request->category_product_descript;
    $data['category_status'] = $request->category_product_status;

     DB::table('tbl_category_product')->insert($data);
     Session::put('message', 'Successfully');
     return Redirect::to('/all-category-product');
} 
public function unactive_category_product($category_product_id){
       $this->AuthLogin();
   DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
  Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
   return Redirect::to('all-category-product');
} 
public function active_category_product($category_product_id){
       $this->AuthLogin();
       DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
       Session::put('message','Không thể kích hoạt danh mục sản phẩm thành công!');
        return Redirect::to('all-category-product');
}
public function edit_category_product($category_product_id){
       $this->AuthLogin();
       $edit_category_product =DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
       $manager_category_product = view('admin.edit-category-product')->with('edit_category_product',$edit_category_product);
       return view('admin_layout')->with('admin.edit-category-product',$manager_category_product);
}
public function update_category_product(Request $request,$category_product_id){
       $this->AuthLogin();
       $data = array();
       $data['category_name'] = $request->category_product_name;
       $data['category_description'] = $request->category_product_descript;
       DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
       Session::put('message','Cap nhat sản phẩm thành công!');
       return Redirect::to('all-category-product');
   
}
public function delete_category_product($category_product_id){
       $this->AuthLogin();
       DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
       Session::put('message','Xoa sản phẩm thành công!');
       return Redirect::to('all-category-product');

}
public function show_category_home($category_id) {
       $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
       $category_by_id = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
       ->where('tbl_product.category_id',$category_id)
       ->get();
       $category_title_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
  return view('page.category.show_category')
  ->with('brand_product', $brand_product)
  ->with('category_product', $cate_product)
  ->with('category_by_id', $category_by_id)
  ->with('category_title', $category_title_name);
}

}
