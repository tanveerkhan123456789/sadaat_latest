<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function Brand()
    { $ware_houses=Brand::get();
        $catagory=Catagory::get();
        return view('backend.pages.brand.brand',get_defined_vars());
    }


    public function BrandStore(Request $request)
    {
        $brand= new Brand(); 
        $brand->catagory_id=$request->catagory_id;

         $brand->brand_name=$request->brand_name;
        if ($request->hasFile('brand_img')) {
           
            $file = $request->file('brand_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/brands/', $filename);
            $brand->brand_img = $filename;
        }

        $brand->save();


        return back()->with('message','Brand Add successfully');
    }


    public function BrandUpdate(Request $request)
    {
        $brand = Brand::find($request->id);
         $brand->brand_name=$request->brand_name;
         $brand->catagory_id=$request->catagory_id;


        if ($request->hasFile('brand_img')) {
            $path = 'storage/app/public/uploads/brands/'.$brand->brand_img;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('brand_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/public/uploads/brands/', $filename);
            $brand->brand_img = $filename;
        }
        $brand->save();


        return back()->with('message','Brand Updated successfully');
    }

    public function BrandDelete(Request $request,$id)
    {
        $brand = Brand::find($id);
         $brand->delete();
    

      
       


                return back();
    }
    
}
