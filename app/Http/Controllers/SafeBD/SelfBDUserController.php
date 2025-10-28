<?php

namespace App\Http\Controllers\SafeBD;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Member;
use App\Models\Setting;
use App\Models\Upazila;
use Illuminate\Http\Request;

class SelfBDUserController extends Controller
{

    public function create()
    {
        $settings = Setting::pluck('value', 'name');
        $divisions = Division::all();
        return view('safebd.fontend.register', compact('settings', 'divisions'));
    }

    // AJAX - Get Districts by Division
    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get();
        return response()->json($districts);
    }

    // AJAX - Get Upazilas by District
    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:member,phone',
            'dateOfBirth' => 'required|date',
            'blood' => 'required',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
        ]);


        // Convert dateOfBirth to Unix timestamp for j_date
        $validated['j_date'] = strtotime($validated['dateOfBirth']);

        // Store in Member table
        Member::create([
            'j_date' => $validated['j_date'],
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'dateOfBirth' => $validated['dateOfBirth'],
            'blood' => $validated['blood'],
            'division_id' => $validated['division_id'],
            'district_id' => $validated['district_id'],
            'upazila_id' => $validated['upazila_id'],
            'zilla' => 'zilla',
            'thana' => 'thana',
            'union' => 'union',
        ]);
        flash()->addSuccess('নিবন্ধন সফল হয়েছে!');

        return redirect()->back();
    }

    public function searchBlood(Request $request)
{
    $settings = Setting::pluck('value', 'name');
    $bloodId = $request->query('blood');

    // Blood group mapping
    $bloodGroups = [
        1 => 'A+',
        2 => 'A-',
        3 => 'AB+',
        4 => 'AB-',
        5 => 'B+',
        6 => 'B-',
        7 => 'O+',
        8 => 'O-'
    ];

    // Get filtered members WITH relationships
    $members = Member::with(['division', 'district', 'upazila'])
                     ->where('blood', $bloodId)
                     ->get();

    $bloodGroup = $bloodGroups[$bloodId] ?? 'Unknown';

    return view('safebd.fontend.search-blood', compact('members', 'bloodGroup', 'bloodId','settings'));
}

    
}