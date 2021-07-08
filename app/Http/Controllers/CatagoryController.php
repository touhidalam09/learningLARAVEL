<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;

class CatagoryController extends Controller {

//    ONLY DISPLAY START
    public function indexCatagory() {
        $catagorys = Catagory::all();
        return view('Catagory.indexCatagory', ['catagorys' => $catagorys]);
    }

    public function addCatagoryView() {
        return view('Catagory.addCatagory');
    }

//    ONLY DISPLAY END
//    CURD START
    public function addCatagory(Request $request) {

        $msg = $msgError = "";

        $validation = $request->validate([
            'catagoryName' => ['required', 'unique:catagorys', 'max:25']
                ], [
            'catagoryName.unique' => 'Already Taken. Try another one',
        ]);


        try {
            $catagory = new Catagory;
            $catagory->catagoryName = $request->catagoryName;
            $catagory->save();
            $msg = "Successfull Add";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/catagory')->with(compact('msg', 'msgError'));
    }

    public function destroyCatagory(Request $request) {
        $msgdlt = $msgError = "";
        try {
            Catagory::destroy($request->id);
            $msgdlt = "Successfull Deleted";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/catagory')->with(compact('msgdlt', 'msgError'));
    }

    public function updateCatagoryById(Request $request) {
        $catagorys = Catagory::find($request->id);
        return view('Catagory.updateCatagory')->with(['catagorys' => $catagorys]);
    }

    public function updateCatagory(Request $request) {
        $msg = $msgError = "";
        $id = $request->id;
    
        $validation = $request->validate([
            'catagoryName' => ['required', 'unique:catagorys', 'max:25']
                ], [
            'catagoryName.unique' => 'Already Taken. Try another one',
        ]);
        try {
            Catagory::where('id', $id)->update([
                'catagoryName' => $request->catagoryName
            ]);
            $msg = "Successfull Updated";
        } catch (\Exception $ex) {
            $msgError = "Error! Feedback this Error: >>> " . $ex->getMessage();
        }
        return redirect('/catagory')->with(compact('msg', 'msgError'));
    }

//    CURD END
//    Ajax
    public function ajaxValidation($catagoryname) {
        $catagorys = Catagory::where('catagoryName', $catagoryname)->first();
        if ($catagorys) {
            echo "Already Exit"; //String Must be not change if change than change ajax script file
        }
    }

}
