<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Catagory;
use App\Models\Brand;
use Illuminate\Support\Composer;

class CustomerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $customers = Customer::select('customers.*', 'brands.brandName as Brand_name', 'catagorys.catagoryName as catagory_name')
                ->leftjoin('brands', 'brands.id', '=', 'customers.brandId_Id')
                ->leftjoin('catagorys', 'catagorys.id', '=', 'customers.catagory_List')
                ->get();
        // dd($customers);
        return view('Customer.indexCustomer', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $msgError = "";
        try {
            $catagories = [0 => '--Select Catagory--'] + Catagory::pluck('catagoryName', 'id')->toArray();
        } catch (\Exception $ex) {
            $msgError = "Selct Option Errror!!";
        }
        return view('Customer.addCustomer', ['catagories' => $catagories, 'msgError' => $msgError]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $imagefile = $request->file('image');
        $imageFileName = time() . "_" . $imagefile->getClientOriginalName();
        $imageDestinationPath = 'uploads/img';
        $imagefile->move($imageDestinationPath, $imageFileName);

        $pdffile = $request->file('pdf');
        $pdfFileName = time() . "_" . $pdffile->getClientOriginalName();
        $pdfDestinationPath = 'uploads/pdf';
        $pdffile->move($pdfDestinationPath, $pdfFileName);

        $current_date_time = now()->toDateTimeString();

        $msg = $msgError = "";
        $customers = new Customer;
        $rules = [
            'customer_Name' => ['required'],
            'customer_Email' => ['required']
        ];
        $request->validate($rules);
        try {
            $customers->customer_Name = $request->customer_Name;
            $customers->customer_Email = $request->customer_Email;
            $customers->catagory_List = $request->catagory_List;
            $customers->brandId_Id = $request->brandId_Id;
            $customers->image = $imageFileName;
            $customers->pdf = $pdfFileName;
            $customers->created_at = $current_date_time;
            $customers->updated_at = $current_date_time;

            $customers->save();
            $msg = "Successfull Added";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        session(['msg' => $msg, 'msgError' => $msgError]);
        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $msgError = "";

        try {
            $catagories = [0 => '--Select Catagory--'] + Catagory::pluck('catagoryName', 'id')->toArray();
            $brands = Brand::pluck('brandName', 'id');

            $uc = Customer::select('customers.*', 'catagorys.id as catagory_List', 'brands.brandName as Brand_name', 'brands.id as brandId_Id')
                    ->leftjoin('brands', 'brands.id', '=', 'customers.brandId_Id')
                    ->leftjoin('catagorys', 'catagorys.id', '=', 'customers.catagory_List')
                    ->where('customers.id', '=', $id)
                    ->first();
        } catch (\Exception $ex) {
            $msgError = "Selct Option Errror!!" . $ex->getMessage();
        }
        session(['msgError' => $msgError]);
        return view('Customer.addCustomer', ['uc' => $uc, 'catagories' => $catagories, 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $id = $request->id;
        $imagefile = $request->file('image');
        $imageFileName = time() . "-" . "-Updated-" . $imagefile->getClientOriginalName();
        $imageDestinationPath = 'uploads/img';
        $imagefile->move($imageDestinationPath, $imageFileName);

        $pdffile = $request->file('pdf');
        $pdfFileName = time() . "-" . "-Updated-" . $pdffile->getClientOriginalName();
        $pdfDestinationPath = 'uploads/pdf';
        $pdffile->move($pdfDestinationPath, $pdfFileName);

        $current_date_time = now()->toDateTimeString();

        $msg = $msgError = "";
        $rules = [
            'customer_Name' => ['required'],
            'customer_Email' => ['required']
        ];
        $request->validate($rules);
        try {
            Customer::where('id', $id)->update([
                'customer_Name' => $request->customer_Name,
                'customer_Email' => $request->customer_Email,
                'catagory_List' => $request->catagory_List,
                'brandId_Id' => $request->brandId_Id,
                'image' => $imageFileName,
                'pdf' => $pdfFileName,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time
            ]);
            $msg = "Successfull Updated";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        session(['msg' => $msg, 'msgError' => $msgError]);
        return redirect('/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $msgdlt = $msgError = "";
        try {
            Customer::destroy($id);
            $msgdlt = "Successfull Deleted";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        session(['msgdlt' => $msgdlt, 'msgError' => $msgError]);
        return redirect('/customers');
    }

    //Ajax After catagory click server send Brand Data
    public function ajaxCatagoryBrand($catagoryId) {

        $brands = Brand::leftjoin('catagorys', 'catagorys.id', '=', 'brands.catagoryId')
                        ->where('catagorys.id', '=', $catagoryId)
                        ->pluck('brands.brandName', 'brands.id')->toArray();
        if ($brands) {
            return $brands;
        }
    }

}
