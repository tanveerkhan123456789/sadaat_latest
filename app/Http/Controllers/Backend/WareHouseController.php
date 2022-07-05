<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function WareHouse()
    {
        $ware_houses = WareHouse::get();
        return view('backend.pages.warehouse.show', get_defined_vars());
    }
    public function WareHouseCreate(Request $request)
    {
        $ware_houses = WareHouse::create($request->all());
        return back()->with('message','Ware house update successfully');;;
    }

    public function WareHouseUpdate(Request $request)
    {
        $ware = WareHouse::where('id', $request->id)->first();
        // dd($request->id)
        $ware_houses = $ware->update($request->all());
        return back()->with('message','Ware house update successfully');;
    }

    public function WareHouseDelete(Request $request,$id)
    {
        
        $ware = WareHouse::find($id);
       $ware->delete();
        return back()->with('error','Delete successfully');
    }
}
