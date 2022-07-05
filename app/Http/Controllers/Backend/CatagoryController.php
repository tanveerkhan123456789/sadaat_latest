<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CatagoryController extends Controller
{
    public function Catagory()
    { $ware_houses=Catagory::get();
        return view('backend.pages.catagory.catagory',get_defined_vars());
    }


    public function CatagoryStore(Request $request)
    {
        $brand= new Catagory(); 
         $brand->catagory_name=$request->catagory_name;
        if ($request->hasFile('catagory_img')) {
           
            $file = $request->file('catagory_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/catagory/', $filename);
            $brand->catagory_img = $filename;
        }

        $brand->save();


        return back()->with('message','Catagory Add successfully');
    }


    public function CatagoryUpdate(Request $request)
    {
        $brand = Catagory::find($request->id);
         $brand->catagory_name=$request->catagory_name;
    

        if ($request->hasFile('catagory_img')) {
            $path = 'storage/app/public/uploads/catagory/'.$brand->catagory_img;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('catagory_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/catagory/', $filename);
            $brand->catagory_img = $filename;
        }
        $brand->save();


        return back()->with('message','Catagory Update successfully');
    }

    public function CatagoryDelete(Request $request,$id)
    {
        $brand = Catagory::find($id);
        $brand->delete();
        return back()->with('error','Catagory Delete successfully');
    }
}
