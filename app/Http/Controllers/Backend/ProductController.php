<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Unit;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\File as FacadesFile;

class ProductController extends Controller
{
  public function Product()
  {
    $Product = Product::get();
    $Catagory = Catagory::get();
    $Unit = Unit::get();
    $Brand = Brand::get();
    $Ware_houses = WareHouse::get();

    return view('backend.pages.product.product', get_defined_vars());
  }

  public function ProductStore(Request $request)
  {


    // dd($request->product_detail);
    $random = Str::random(8);

    $pro = new Product();
    if (empty($request->product_feature)) {
      $feature = "no";
    } else {
      $feature = "yes";
    }


    if (empty($request->product_different_warehouse)) {
      $product_different_warehouse = "no";
    } else {
      $product_different_warehouse = "yes";
    }

    if (empty($request->product_different_warehouse)) {
      $product_add_warehouse = "no";
    } else {
      $product_add_warehouse = "yes";
    }
    $pro->product_detail = $request->product_detail;
    $pro->product_name = $request->product_name;
    $pro->product_code = $random;
    $pro->product_unit = $request->product_unit;
    $pro->product_sale_unit = $request->product_sale_unit;
    $pro->product_purchase_unit = $request->product_purchase_unit;
    $pro->product_brand = $request->product_brand;
    $pro->product_catagory = $request->product_catagory;
    $pro->product_cost = $request->product_cost;
    $pro->product_price = $request->product_price;
    $pro->product_method = $request->product_method;
    $pro->product_feature = $feature;
    $pro->product_different_warehouse = $product_different_warehouse;
    $pro->product_add_warehouse = $product_add_warehouse;
    $pro->product_warehouse = $request->product_warehouse;
    $pro->product_warehouse_price = $request->product_warehouse_price;
    $pro->product_promotional_price = $request->product_promotional_price;
    $pro->product_promotional_start = $request->product_promotional_start;
    $pro->product_promotional_end = $request->product_promotional_end;
    $pro->product_quantity = $request->product_quantity;

    if ($request->hasFile('product_img')) {

      $file = $request->file('product_img');
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '.' . $extension;
      $file->move('storage/app/public/uploads/product/', $filename);
      $pro->product_img = $filename;
    }
    $pro->save();
    return back()->with('message', 'Products Add successfully');;
  }

  public function ProductUpdate(Request $request)
  {

    $pro = Product::where('id', $request->id)->first();

    $random = Str::random(8);

    $pro->product_detail = $request->product_detail;
    $pro->product_name = $request->product_name;
    $pro->product_code = $random;
    $pro->product_unit = $request->product_unit;
    $pro->product_sale_unit = $request->product_sale_unit;
    $pro->product_purchase_unit = $request->product_purchase_unit;
    $pro->product_brand = $request->product_brand;
    $pro->product_catagory = $request->product_catagory;
    $pro->product_cost = $request->product_cost;
    $pro->product_price = $request->product_price;
    $pro->product_method = $request->product_method;
    $pro->product_feature = $random;
    $pro->product_different_warehouse = $request->product_different_warehouse;
    $pro->product_add_warehouse = $request->product_add_warehouse;
    $pro->product_warehouse = $request->product_warehouse;
    $pro->product_warehouse_price = $request->product_warehouse_price;
    $pro->product_promotional_price = $request->product_promotional_price;
    $pro->product_promotional_start = $request->product_promotional_start;
    $pro->product_promotional_end = $request->product_promotional_end;
    $pro->product_quantity = $request->product_quantity;
    if (empty($request->product_feature)) {
      $feature = "no";
    } else {
      $feature = "yes";
    }
    if ($request->hasFile('product_img')) {
      $path = 'storage/app/public/uploads/product/' . $pro->product_img;
      if (File::exists($path)) {
        File::delete($path);
      }
      $file = $request->file('product_img');
      $extension = $file->getClientOriginalExtension();
      $filename = time() . '.' . $extension;
      $file->move('storage/app/public/uploads/product/', $filename);
      $pro->product_img = $filename;
    }
    $pro->save();
    return back()->with('message', 'Product update successfully');;
  }

  public function ProductDelete(Request $request, $id)
  {

    $ware = Product::find($id);
    $ware->delete();
    return back()->with('error', 'Product Delete successfully');
  }
}
