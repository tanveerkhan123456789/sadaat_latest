<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Purchase;
use App\Models\Purchase_product;
use App\Models\Sale;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SaleController extends Controller
{
    
    public function Sale()
    {
        $sale = Purchase::with('ware')->where('type','sale')->get();
        // dd($sale);
        $warehouses = WareHouse::get();
        $warehouses = WareHouse::get();
        $products = Purchase_product::distinct()->get(['product_id']);

        $ware_houses = WareHouse::get();
        $customers = Customer::get();



    //     $sales = DB::table('purchases')
    //         ->leftJoin('product_sales','purchases.id', '=','product_sales.sale_id')
            
    //         ->get();
    //    dd($sales);
        return view('backend.pages.sales.sales', get_defined_vars());
    }



    public function SaleReport(Request $request)
    {
        $sale = Purchase::with('ware')->where('type','sale')->get();
        // dd($sale);
        $warehouses = WareHouse::get();
        $warehouses = WareHouse::get();
        $products = Purchase_product::distinct()->get(['product_id']);

        $ware_houses = WareHouse::get();
        $customers = Customer::get();

if($request->warehouse_id)
{
    $sale = Purchase::where('type','sale')->where('warehouse_id',$request->warehouse_id)->get();
    return view('backend.pages.sales.salereport', get_defined_vars());

}
if ($request->customer_id) {
    $sale = Purchase::where('type','sale')->where('customer_id',$request->customer_id)->get();
    // dd($purchases);
  
    return view('backend.pages.sales.salereport', get_defined_vars());
}
if ( $request->start_date && $request->end_date) {
    $sale = Purchase::where('type','sale')
    ->where('created_at', '>=', $request->start_date)
    ->where('created_at', '<=', $request->end_date)->get();
    // dd($purchases);
 
    return view('backend.pages.sales.salereport', get_defined_vars());
}

// dd($request->start_date);
if ($request->start_date) {

    $sale = Purchase::with('product_purchase')->where('type', 'sale')
        ->where('created_at',$request->start_date)->get();
  
        return view('backend.pages.sales.salereport', get_defined_vars());
    }


if ($request->end_date) {

    $sale = Purchase::with('product_purchase')->where('type', 'sale')
        ->where('created_at',$request->end_date)->get();
  
        return view('backend.pages.sales.salereport', get_defined_vars());
    }
    //     $sales = DB::table('purchases')
    //         ->leftJoin('product_sales','purchases.id', '=','product_sales.sale_id')
            
    //         ->get();
    //    dd($sales);
        return view('backend.pages.sales.salereport', get_defined_vars());
    }
    public function addsaleview()
    {
        $sale = Purchase::with('ware')->where('type','sale')->get();
        // dd($sale);
        $warehouses = WareHouse::get();
        $warehouses = WareHouse::get();
        $products = Purchase_product::distinct()->get(['product_id']);

        $ware_houses = WareHouse::get();
        $customers = Customer::get();



    //     $sales = DB::table('purchases')
    //         ->leftJoin('product_sales','purchases.id', '=','product_sales.sale_id')
            
    //         ->get();
    //    dd($sales);
        return view('backend.pages.sales.newsales', get_defined_vars());
    }

    public function SaleUpdate(Request $request, $id)
    {
// new code
$products = Purchase::get();

// new code

        $sale_first = Purchase::with('product_sale')->where('id', $id)->first();
        $warehouses = WareHouse::get();
        $products = Purchase_product::get();

        $users = Product::join('purchase_products', 'products.id', '=', 'purchase_products.product_id')
            ->get('products.*', 'purchase_products.name', 'purchase_products.product_id');
        //  dd($sale_first);
        $warehouses = WareHouse::get();
        // $products = Product::get();
        $ware_houses = WareHouse::get();
        $suppliers = Customer::get();

        return view('backend.pages.sales.edit', get_defined_vars());
    }

    public function saleStore(Request $request)
    {
        $size = count($request->get('product_id'));
        $subJob = new Purchase();
        $subJob->user_id = Auth::guard('admin')->user()->id;
        $subJob->warehouse_id = $request->warehouse_id;
        $subJob->item = $size;
        $subJob->customer_id = $request->supplier_id;
        $subJob->customer_id = $request->customer_id;
        $subJob->total_qty = $request->total_quantity;
        $subJob->order_discount = $request->order_discount;
        $subJob->payment_status = $request->payment_status;
        $subJob->order_status = $request->order_status;
        $subJob->grand_total = $request->grand_total;
        $subJob->shipping_cost = $request->shipping_cost;
        $subJob->order_discount = $request->order_discount;
        $subJob->note = $request->sale_note;

        $subJob->staf_note = $request->sale_note;
        $subJob->total_cost = $request->sub_total;
        $subJob->type="sale";

        if ($request->hasFile('document')) {

            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/sale/', $filename);
            $subJob->document = $filename;
        }
        $subJob->save();
        //         $value=Sale::where('id',$subJob->id)->first();
        // $value->local_id=$subJob->id;
        // $value->save();
        for ($i = 0; $i  < $size; $i++) {
            $purchase = Purchase_product::where('product_id', $request->product_id[$i])->first();

            $purchase->avaiable_stock = $purchase->avaiable_stock -  $request->get('qty')[$i];
            $purchase->save();
            $Productsd = new ProductSale();
            $Productsd->sale_id =$subJob->id;

            $Productsd->product_id = $request->get('product_id')[$i];
            $Productsd->product_name = $request->get('name')[$i];
            $Productsd->product_total_price = $request->get('product_subtot')[$i];
            $Productsd->product_qty = $request->get('qty')[$i];
            $Productsd->product_unit_price = $request->get('price')[$i];
            $Productsd->save();
        }
        return back()->with('message', 'Sale Add successfully');
    }



    public function saleStoreupdatedata(Request $request, $id)
    {
        $subJob = Purchase::where('id', $id)->first();
      $user_id=  Auth::guard('admin')->user()->id;
        if ($request->product_id == null) {

            $subJob->user_id = $user_id;
            $subJob->warehouse_id = $request->warehouse_id;
            $subJob->item = 0;
            $subJob->total_qty = $request->total_quantity;
            $subJob->order_discount = $request->order_discount;
            $subJob->customer_id = $request->customer_id;
            $subJob->grand_total = $request->grand_total;
        $subJob->payment_status = $request->payment_status;
        $subJob->order_status = $request->order_status;
        $subJob->shipping_cost = $request->shipping_cost;
        $subJob->order_discount = $request->order_discount;
        $subJob->note = $request->sale_note;
        $subJob->staf_note = $request->sale_note;
        $subJob->total_cost = $request->sub_total;
        $subJob->type="sale";

            if ($request->hasFile('document')) {
                $path = 'storage/app/public/uploads/sale/' . $subJob->document;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('storage/app/public/uploads/catagory/', $filename);
                $subJob->document = $filename;
            }
            $subJob->save();


            $delete_sale = ProductSale::where('sale_id', $id);
            $delete_sale->delete();
            return redirect()->back()->with('message', 'Sale Add successfully');
        } else {
            $size = count($request->product_id);
            $subJob->user_id = $user_id;
            $subJob->warehouse_id = $request->warehouse_id;
            $subJob->item = $size;
            $subJob->total_qty = $request->total_quantity;
            $subJob->order_discount = $request->order_discount;
            $subJob->customer_id = $request->customer_id;
            $subJob->grand_total = $request->grand_total;
        $subJob->payment_status = $request->payment_status;
        $subJob->order_status = $request->order_status;
        $subJob->shipping_cost = $request->shipping_cost;
        $subJob->order_discount = $request->order_discount;
        $subJob->note = $request->sale_note;
        $subJob->staf_note = $request->sale_note;
        $subJob->total_cost = $request->sub_total;
        $subJob->type="sale";

            if ($request->hasFile('document')) {
                $path = 'storage/app/public/uploads/sale/' . $subJob->document;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('storage/app/public/uploads/catagory/', $filename);
                $subJob->document = $filename;
            }
            $subJob->save();
            $delete_sale = ProductSale::where('sale_id', $id);
            $delete_sale->delete();
            for ($i = 0; $i  < $size; $i++) {

                $purchase = Purchase_product::where('product_id', $request->product_id[$i])->first();

            $purchase->avaiable_stock = $purchase->avaiable_stock -  $request->get('qty')[$i];
            $purchase->qty = $purchase->qty -  $request->get('qty')[$i];

            $purchase->save();
            $Productsd = new ProductSale();
            $Productsd->sale_id =$subJob->id;

                $Product_sale = new ProductSale();

                $Product_sale->sale_id = $subJob->id;
                $Product_sale->product_id = $request->get('product_id')[$i];
                $Product_sale->product_name = $request->get('name')[$i];

                $Product_sale->product_total_price = $request->get('product_subtot')[$i];
                $Product_sale->product_qty = $request->get('qty')[$i];
                $Product_sale->product_unit_price = $request->get('price')[$i];
                $Product_sale->save();
            }
            return redirect()->back()->with('message', 'Sale is Updated successfully');
        }
    }
}
