<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerGroupController extends Controller
{
    public function createCustomerGroup()
    {
        return view('backend.pages.customer_group.index');
    }

    public function getCustomerGroup()
    {
        $customer_group = Customer_group::all();
        return $customer_group;
    }

    public function customerGroupStore(Request $request)
    {

        $data = $request->all();
        $rules = array(
            'group_name' => 'required',
            'group_percentage' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);
        }

        $customer_group = new Customer_group();
        $customer_group->name = $request->input('group_name');
        $customer_group->percentage = $request->input('group_percentage');
        
        $customer_group->save();
        return response()->json([
            'status' => 200,
            'message' => 'Customer group added successfully',
        ]);
    }

    public function customerGroupEdit(Request $request)
    {
        $customer_group = Customer_group::find($request->id);
        return response()->json([
            'customer_group' => $customer_group,
        ]);
    }

    public function customerGroupUpdate(Request $request)
    {
        $customer_group = Customer_group::find($request->customer_group_id);
        $customer_group->name = $request->input('name');
        $customer_group->percentage = $request->input('percentage');
        
        $customer_group->save();
        return response()->json([
            'status' => 200,
            'message' => 'Customer group update successfully',
        ]);
    }

    public function customerGroupDelete(Request $request)
    {
        $customer_group = Customer_group::find($request->id);
        if ($customer_group) {
            $customer_group->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer group deleted successfully',
            ]);
        }
    }
}
