<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\WareHouse;
use App\Models\Admin;
use App\Models\Catagory;
use App\Models\Purchase_product;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        $purchases = Purchase::where('type', 'purchase')->get();
        $purchase_products = Purchase_product::all();
        return view('backend.pages.purchase.index', get_defined_vars());
    }

    public function reportpurchases(Request $request)
    {
        $purchases = Purchase::with('product_purchase')->where('type', 'purchase')->get();
        // dd($purchases);
        $products = Product::all();
        $warehouses = WareHouse::all();
        // $catagory=Catagory::get();
        $supplier = Supplier::get();
        // if ($request->warehouse_id) {
        //     $purchases = Purchase::with('product_purchase')->where('type', 'purchase')->where('warehouse_id', $request->warehouse_id)->get();
        //     // dd($purchases);
        //     $products = Product::all();
        //     $warehouses = WareHouse::all();
        //     return view('backend.pages.purchase.purchase_report', get_defined_vars());

        // }
        if ($request->supplier_id  && $request->warehouse_id && $request->start_date && $request->end_date) {
            $supplier = Supplier::get();

            $purchases = Purchase::with('product_purchase')->where('type', 'purchase')
                ->Where('warehouse_id', $request->warehouse_id)
                ->Where('supplier_id', $request->supplier_id)
                ->Where('created_at','>=', $request->start_date)
                ->Where('created_at','<=', $request->end_date)
             
                ->get();

            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }
 
        if ($request->warehouse_id) {
            $supplier = Supplier::get();

            $purchases = Purchase::with('product_purchase')->where('type', 'purchase')
                ->Where('warehouse_id', $request->warehouse_id)->get();
            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }

        if ($request->supplier_id) {
            $supplier = Supplier::get();

            $purchases = Purchase::with('product_purchase')->where('type','purchase')
                ->Where('supplier_id', $request->supplier_id)->get();
            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }
        if ( $request->start_date && $request->end_date) {
            $supplier = Supplier::get();
            $purchases = Purchase::with('product_purchase')->where('type','purchase')
            ->where('created_at', '>=', $request->start_date)
            ->where('created_at', '<=', $request->end_date)->get();
            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }
        
        // dd($request->start_date);
        if ($request->start_date) {
            $supplier = Supplier::get();

            $purchases = Purchase::with('product_purchase')->where('type', 'purchase')
                ->where('created_at',$request->start_date)->get();
            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }


        if ($request->end_date) {
            $supplier = Supplier::get();

            $purchases = Purchase::with('product_purchase')->where('type', 'purchase')
                ->where('created_at',$request->end_date)->get();
            // dd($purchases);
            $products = Product::all();
            $warehouses = WareHouse::all();
            return view('backend.pages.purchase.purchase_report', get_defined_vars());
        }


        return view('backend.pages.purchase.purchase_report', get_defined_vars());
    }
    public function createPurchase()
    {
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('backend.pages.purchase.create', get_defined_vars());
    }

    public function getProductDetail(Request $request)
    {
        $data = Product::where('id', $request->product_id)->first();
        $Purchase_product = Purchase_product::where('product_id', $request->product_id)->first();
        return response()->json([$data, $Purchase_product]);
    }

    public function qtydata(Request $request)
    {
        $Purchase_product = Purchase_product::where('product_id', $request->product_id)->first();
        return $Purchase_product;
    }
    public function updatePurchase(Request $request, $id)
    {
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $first = Purchase::with('product_purchase')->where('id', $id)->first();
        // dd($first);

        return view('backend.pages.purchase.update', get_defined_vars());
    }
    public function updatePurchaseData(Request $request, $id)
    {

        $user_id =  Auth::guard('admin')->user()->id;
        $size = count($request->product_id);

        $purchase = Purchase::where('id', $id)->first();
        $purchase->user_id = $user_id;
        $purchase->warehouse_id = $request->warehouse_id;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->payment_status = $request->payment_status;
        $purchase->order_discount = $request->order_discount;
        $purchase->shipping_cost = $request->shipping_cost;
        $purchase->note = $request->note;
        $purchase->total_qty = $request->total_qty;
        $purchase->total_cost = $request->total_cost;
        $purchase->order_discount = $request->order_discount;
        $purchase->shipping_cost = $request->shipping_cost;
        $purchase->grand_total = $request->grand_total;
        $purchase->due_ammount = $request->grand_total;
        $purchase->item = $size;
        $purchase->type = 'purchase';

        if ($request->hasFile('document')) {

            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/document/', $filename);
            $purchase->document = $filename;
        }

        $purchase->save();
        $delete_sale = Purchase_product::where('purchase_id', $id);
        $delete_sale->delete();

        for ($i = 0; $i < $size; $i++) {

            $pur = new Purchase_product();
            $pur->purchase_id = $purchase->id;
            $pur->product_id = $request->product_id[$i];
            $pur->name = $request->name[$i];
            // $pur->code = $request->code[$i];
            $pur->qty = $request->qty[$i];
            $pur->sale_price = $request->sale_price[$i];
            $pur->avaiable_stock = $request->qty[$i];

            $pur->net_unit_cost = $request->net_unit_cost[$i];
            $pur->total = $request->total[$i];
            $pur->save();
        }

        return back()->with('message', 'Purchase Update successfully');
    }

    public function storPurchase(Request $request)
    {
        $user_id =  Auth::guard('admin')->user()->id;
// $all_account=Account::get();
// dd($all_account);
        $size = count($request->product_id);

        $purchase = new Purchase();
        $purchase->user_id = $user_id;
        $purchase->warehouse_id = $request->warehouse_id;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->payment_status = $request->payment_status;
        $purchase->order_discount = $request->order_discount;
        $purchase->shipping_cost = $request->shipping_cost;
        $purchase->note = $request->note;
        $purchase->total_qty = $request->total_qty;
        $purchase->order_discount = $request->order_discount;
        $purchase->shipping_cost = $request->shipping_cost;
        $purchase->grand_total = $request->grand_total;
        if($request->payment_status==2)
{
        $purchase->due_ammount = $request->due_amount;
        $purchase->paid_amount = $request->pay_amount;

        $purchase->item = $request->item;
        $purchase->type = 'purchase';

        if ($request->hasFile('document')) {

            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/document/', $filename);
            $purchase->document = $filename;
        }

        $purchase->save();
    }
    else{
        $purchase->due_ammount = '0';
        $purchase->paid_amount =$request->grand_total;

        $purchase->item = $request->item;
        $purchase->type = 'purchase';

        if ($request->hasFile('document')) {

            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/document/', $filename);
            $purchase->document = $filename;
        }

        $purchase->save();
    }


        for ($i = 0; $i < $size; $i++) {
            $check_purchase = Purchase_product::where('product_id', $request->product_id[$i])->first();
            if (!empty($check_purchase)) {
                $check_purchase->avaiable_stock = $check_purchase->avaiable_stock + $request->qty[$i];
                // $check_purchase->qty = $check_purchase->qty + $request->qty[$i];
                $check_purchase->save();
            } else {
                $pur = new Purchase_product();
                $pur->product_id = $request->product_id[$i];
                $pur->purchase_id = $purchase->id;
                $pur->sale_price = $request->sale_price[$i];
                $pur->avaiable_stock = $request->qty[$i];

                $pur->name = $request->name[$i];
                $pur->qty = $request->qty[$i];
                $pur->net_unit_cost = $request->net_unit_cost[$i];
                $pur->total = $request->total[$i];
                $pur->save();
            }
        }

        if($request->payment_status==2)
        { 
            $account=new Account();
            $account->supplier_id=$request->supplier_id;
            $account->user_id=$user_id;
            $account->purchase_id=$purchase->id;
            $account->pay_amount=$request->pay_amount;
            $account->due_amount=$request->due_amount;
$account->save();


        }
        else{
            $account=new Account();
            $account->supplier_id=$request->supplier_id;
            $account->user_id=$user_id;
            $account->purchase_id=$purchase->id;
            $account->pay_amount=$request->grand_total;
            $account->due_amount='0';
$account->save();


        }

        return back()->with('message', 'Purchase Added successfully');
    }
}
