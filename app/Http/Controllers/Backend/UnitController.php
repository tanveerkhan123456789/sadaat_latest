<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function Unit()
    {
        $Unit = Unit::get();
        return view('backend.pages.unit.unit', get_defined_vars());
    }

    public function UnitStore(Request $request)
    {
        $ware_houses = Unit::create($request->all());
        return back()->with('message','Unit Add successfully');;
    }

    public function UnitUpdate(Request $request)
    {
        $ware = Unit::where('id', $request->id)->first();
        // dd($request->id)
        $ware_houses = $ware->update($request->all());
        return back()->with('message','Unit update successfully');;
    }

    public function UnitDelete(Request $request,$id)
    {
        
        $ware = Unit::find($id);
       $ware->delete();
        return back()->with('error','Unit Delete successfully');
    }
}
