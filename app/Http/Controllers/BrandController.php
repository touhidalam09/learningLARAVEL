<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Brand;

class BrandController extends Controller {

    //    Brand Display START
    public function display() {

        $brands = Brand::Select('brands.id', 'catagorys.catagoryName as catagoryName', 'brands.brandName')
                ->leftjoin('catagorys', 'catagorys.id', '=', 'brands.catagoryId')
                ->get();

        return view('Brand.indexBrand', compact('brands'));
    }

    public function addbrandView() {
        $catagories = [0 => '--Select Catagory--'] + Catagory::pluck('catagoryName', 'id')->toArray();

        return view('Brand.addBrand', compact('catagories'));
    }

    //    Brand Display END
    //    CURD START 
    public function addBrand(Request $request) {
        $msg = $msgError = "";
        $catagoryId = $request->catagoryId;
        $rules = [
            'catagoryId' => ['required'],
            'brandName' => ['required']
        ];
        $request->validate($rules);
        try {
            $brand = new Brand;
            $brand->catagoryId = $catagoryId;
            $brand->brandName = $request->brandName;
            $brand->save();
            $msg = "Successfull Added";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/brand')->with(compact('msg', 'msgError'));
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $msgdlt = $msgError = "";
        try {
            Brand::destroy($request->id);
            $msgdlt = "Successfull Deleted";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/brand')->with(compact('msgdlt', 'msgError'));
    }

    public function updateBrandById(Request $request) {
        $brand = Brand::find($request->id);
        $catagories = Catagory::pluck('catagoryName', 'id')->toArray();
        return view('Brand.updateBrand', compact('brand', 'catagories'));
    }

    public function updateBrand(Request $request) {


        $msg = $msgError = "";
        $id = $request->id;
        $catagoryId = (int) $request->catagoryId;

        $request->validate([
            'catagoryId' => ['required'],
            'brandName' => ['required']
        ]);

        try {
            Brand::where('id', $id)->update([
                'catagoryId' => $catagoryId,
                'brandName' => $request->brandName
            ]);
            $msg = "Successfull Updated";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/brand')->with(compact('msg', 'msgError'));
    }

    // Ajax Validation 
    public function ajaxValidation(Request $request) {
        $catagoryId = (int) $request->catagoryId;
        $brandName = $request->brandName;

        $brand = Brand::where('catagoryId', $catagoryId)
                ->where('brandName', $brandName)
                ->first();
        if ($brand) {
            echo "Already Exit";
        }
    }

}
