<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function createCustomer()
    {
        $customer_groups = Customer_group::all();
        return view('backend.pages.customer.index', compact('customer_groups'));
    }

    public function getCustomer()
    {
        $customer = Customer::with('customergroup')->get();
        return $customer;
    }

    public function customerStore(Request $request)
    {
        $data = $request->all();
        $rules = array(
            'customer_group_id' => 'required',
            'name' => 'required',
            'company_name' => 'required',
            'tax_number' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'p_code' => 'required',
            'country' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);
        }

        $customer = new Customer();
        $customer->customer_group_id = $request->input('customer_group_id');
        $customer->name = $request->input('name');
        $customer->company_name = $request->input('company_name');
        $customer->tax_number = $request->input('tax_number');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->city = $request->input('city');
        $customer->state = $request->input('state');
        $customer->p_code = $request->input('p_code');
        $customer->country = $request->input('country');
        $customer->status = "0";

        $customer->save();
        return response()->json([
            'status' => 200,
            'message' => 'Customer added successfully',
        ]);
    }

    public function customerEdit(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer_groups = Customer_group::all();
        return response()->json([
            'customer' => $customer,
            'customer_groups' => $customer_groups,
        ]);
    }

    public function customerUpdate(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->customer_group_id = $request->input('customer_group_id');
        $customer->name = $request->input('name');
        $customer->company_name = $request->input('company_name');
        $customer->tax_number = $request->input('tax_number');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->city = $request->input('city');
        $customer->state = $request->input('state');
        $customer->p_code = $request->input('p_code');
        $customer->country = $request->input('country');

        $customer->save();
        return response()->json([
            'status' => 200,
            'message' => 'Customer update successfully',
        ]);
    }

    public function customerDelete(Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Customer deleted successfully',
            ]);
        }
    }
}
