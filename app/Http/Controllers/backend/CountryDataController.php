<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;

class CountryDataController extends Controller {

    public function getdivision($division_id){

    $division = District::where('division_id', $division_id)->orderBy('name_en','ASC')->get();
        return json_encode($division);
    }

    public function getupazilla($district_id){
        $upazilla = Upazila::where('district_id', $district_id)->orderBy('name_en','ASC')->get();

        return json_encode($upazilla);
    }
    
    public function getunion($upazilla_id){
        $union = Union::where('upazilla_id', $upazilla_id)->orderBy('name_en','ASC')->get();
        
        return json_encode($union);
    }

    public function index(){
        return view('admin.division.index',[
            'divisions' => Division::all(),
        ]);
    }

    public function StoreDivision(Request $request){
        $division_en = Division::where('name_en', $request->division_en)->get();
        $division_bn = Division::where('name_bn', $request->division_bn)->get();
        $request->validate([
            'division_en' => ['required','min:3','max: 60'],
            'division_bn' => ['required','min:3','max: 60'],
        ]);

        if((count($division_en) < 1) && (count($division_bn) < 1)){
            $division = Division::create([
                'name_en' => $request->division_en,
                'name_bn' => $request->division_bn,
                'status' => '1',
                'url' => $request->url,
            ]);
            if($division){
                return redirect()->back()->with('success', 'Division Added Successfull.');
            }
        }
        else{
            return redirect()->back()->with('error', 'Division Already Have, Please Try Another.');
        }  
    }

    public function DivisionDelete($id){
        $division = Division::findOrFail($id);
        $division->delete();
        return redirect()->back()->with('success', 'Division Delete Successfull.');
    }
    public function DistrictIndex(){
        return view('admin.district.index',[
            'divisions' => Division::all(),
            'districts' => District::all(),
        ]);
    }
    public function StoreDistrict(Request $request){
        $district_en = District::where('name_en', $request->en)->get();
        $district_bn = District::where('name_bn', $request->bn)->get();
        $request->validate([
            'en' => ['required','min:3','max: 60'],
            'bn' => ['required','min:3','max: 60'],
            'division' => ['required'],
        ]);

        if((count($district_en) < 1) && (count($district_bn) < 1)){
            $district = District::create([
                'division_id' => $request->division,
                'name_en' => $request->en,
                'name_bn' => $request->bn,
                'status' => '1',
                'url' => $request->url,
            ]);
            if($district){
                return redirect()->back()->with('success', 'District Added Successfull.');
            }

        }
        else{
            return redirect()->back()->with('error', 'District Already Have, Please Try Another.');
        }  
    }

    public function districtDelete($id){
        $district = District::findOrFail($id);
        $district->delete();
        return redirect()->back()->with('success', 'District Delete Successfull.');
    }

    public function SubdistrictIndex(){
        return view('admin.upazila.index',[
            'divisions' => Division::all(),
            'subdistricts' => Upazila::all(),
        ]);
    }
    
    public function SubdistrictAjax($id){
        $District = District::where('division_id', $id)->get();
        return response()->json($District);
    }

    public function StoreSubdistrict(Request $request){
        $subdistrict_en = Upazila::where('name_en', $request->en)->get();
        $subdistrict_bn = Upazila::where('name_bn', $request->bn)->get();
        $request->validate([
            'en' => ['required','min:3','max: 60'],
            'bn' => ['required','min:3','max: 60'],
            'district' => ['required'],
        ]);

        if((count($subdistrict_en) < 1) && (count($subdistrict_bn) < 1)){
            $subdistrict = Upazila::create([
                'district_id' => $request->district,
                'name_en' => $request->en,
                'name_bn' => $request->bn,
                'status' => '1',
                'url' => $request->url,
            ]);
            if($subdistrict){
                return redirect()->back()->with('success', 'Sub District Added Successfull.');
            }

        }
        else{
            return redirect()->back()->with('error', 'Sub District Already Have, Please Try Another.');
        }  
    }

    public function SubdistrictDelete($id){
        $district = Upazila::findOrFail($id);
        $district->delete();
        return redirect()->back()->with('success', 'Sub District Delete Successfull.');
    }

    public function UnionIndex(){
        return view('admin.union.index',[
            'divisions' => Division::all(),
            'unions' => Union::all(),
        ]);
    }

    public function Unionajax($id){
        $Upazila = Upazila::where('district_id', $id)->get();
        return response()->json($Upazila);
    }
    public function UpzilatoUnionjax($id){
        $Union = Union::where('upazilla_id', $id)->get();
        return response()->json($Union);
    }

    public function StoreUnion(Request $request){
        // dd($request->all());
        $union_en = Union::where('name_en', $request->en)->get();
        $union_bn = Union::where('name_bn', $request->bn)->get();
        $request->validate([
            'en' => ['required','min:3','max: 60'],
            'bn' => ['required','min:3','max: 60'],
            'subdistrict' => ['required'],
        ]);

        if((count($union_en) < 1) && (count($union_bn) < 1)){
            $union = Union::create([
                'upazilla_id' => $request->subdistrict,
                'name_en' => $request->en,
                'name_bn' => $request->bn,
                'status' => '1',
                'url' => $request->url,
            ]);
            if($union){
                return redirect()->back()->with('success', 'Union Added Successfull.');
            }

        }
        else{
            return redirect()->back()->with('error', 'This Union Already Have, Please Try Another.');
        }  
    }

    
    public function UnionDelete($id){
        $Union = Union::findOrFail($id);
        $Union->delete();
        return redirect()->back()->with('success', 'Union Delete Successfull.');
    }

}
