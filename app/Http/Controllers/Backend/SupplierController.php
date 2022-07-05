<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function createSupplier()
    {
        return view('backend.pages.supplier.index');
    }

    public function getSupplier()
    {
        $supliers = Supplier::all();
        return $supliers;
    }

    public function supplierStore(Request $request)
    {

        $data = $request->all();
        $rules = array(
            'name' => 'required',
            'company_name' => 'required',
            'vat_number' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'p_code' => 'required',
            'country' => 'required',
            'image' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);
        }

        $suplier = new Supplier();
        $suplier->name = $request->input('name');
        $suplier->company_name = $request->input('company_name');
        $suplier->vat_number = $request->input('vat_number');
        $suplier->email = $request->input('email');
        $suplier->phone = $request->input('phone');
        $suplier->address = $request->input('address');
        $suplier->city = $request->input('city');
        $suplier->state = $request->input('state');
        $suplier->p_code = $request->input('p_code');
        $suplier->country = $request->input('country');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/supplier/', $filename);
            $suplier->image = $filename;
        }

        $suplier->save();
        return response()->json([
            'status' => 200,
            'message' => 'Supplier added successfully',
        ]);
    }

    public function supplierEdit(Request $request)
    {
        $suplier = Supplier::find($request->id);
        return response()->json([
            'suplier' => $suplier,
        ]);
    }

    public function supplierUpdate(Request $request)
    {
        $suplier = Supplier::find($request->supplier_id);
        $suplier->name = $request->input('name');
        $suplier->company_name = $request->input('company_name');
        $suplier->vat_number = $request->input('vat_number');
        $suplier->email = $request->input('email');
        $suplier->phone = $request->input('phone');
        $suplier->address = $request->input('address');
        $suplier->city = $request->input('city');
        $suplier->state = $request->input('state');
        $suplier->p_code = $request->input('p_code');
        $suplier->country = $request->input('country');

        if ($request->hasFile('image')) {
            $path = 'storage/app/public/uploads/supplier/'.$suplier->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/supplier/', $filename);
            $suplier->image = $filename;
        }

        $suplier->save();
        return response()->json([
            'status' => 200,
            'message' => 'Supplier updated successfully',
        ]);
    }

    public function supplierDelete(Request $request)
    {
        $suplier = Supplier::find($request->id);
        if ($suplier) {
            $path = 'storage/app/public/uploads/supplier/' . $suplier->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $suplier->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Supplier deleted successfully',
            ]);
        }
    }
}
