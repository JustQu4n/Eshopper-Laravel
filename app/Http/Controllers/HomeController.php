<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
  public function index(){
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->get();
    return view('page.home')->with('categories',$cate_product)->with('brand',$brand_product)->with('products',$all_product);
  }
}
