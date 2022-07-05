<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use App\Models\Customer;
use App\Models\Customer_group;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class POSController extends Controller
{
    public function index()
    {
        $warehouses = WareHouse::all();
        $customers = Customer::all();
        $customer_groups = Customer_group::all();
        // $categories = Catagory::all();
        $index="1";
        return view('backend.pages.pos.index', get_defined_vars());
    }
}
