<?php

namespace App\Http\Controllers\API;

use App\MoreEmployeeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoreDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {

    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'type_of_employee_id' => 'required',
            'employee_base_id' => 'required',
            'position_id' => 'required',
            'tin_num' => 'required',
            'pag_ibig_num' => 'required',
            'gsis_bp_num' => 'required',
            'philhealth_num' => 'required',
            'spouse_phone' => 'nullable|regex:/^[0-9]*$/|min:10|max:10',
            'emergency_name' => 'required',
            'emergency_phone' => 'required|regex:/^[0-9]*$/|min:10|max:10',
            'emergency_address' => 'required',
            'emergency_relationship' => 'required',
        ]);

        MoreEmployeeDetail::create([
            'user_id' => $request->user_id,
            'employee_personal_detail_id' => $request->employee_personal_detail_id,
            'type_of_employee_id' => $request->type_of_employee_id,
            'employee_base_id' => $request->employee_base_id,
            'position_id' => $request->position_id,
            'subject_id' => $request->subject_id,
            'area_id' => $request->area_id,
            'component_id' => $request->component_id,
            'grade_level_id' => $request->grade_level_id,
            'levels_of_civil_id' => $request->levels_of_civil_id,
            'tin_num' => $request->tin_num,
            'pag_ibig_num' => $request->pag_ibig_num,
            'gsis_bp_num' => $request->gsis_bp_num,
            'philhealth_num' => $request->philhealth_num,
            'lbp_num' => $request->lbp_num,
            'prc_license' => $request->prc_license,
            'highest_grade_degree_rec' => $request->highest_grade_degree_rec,
            'year_received' => $request->year_received,
            'institution_name' => $request->institution_name,
            'spec_qualification' => $request->spec_qualification,
            'previous_experience' => $request->previous_experience,
            'emergency_name' => $request->emergency_name,
            'emergency_relationship' => $request->emergency_relationship,
            'emergency_address' => $request->emergency_address,
            'emergency_phone' => $request->emergency_phone,
            'spouse_name' => $request->spouse_name,
            'spouse_occ' => $request->spouse_occ,
            'spouse_add' => $request->spouse_add,
            'spouse_phone' => $request->spouse_phone,
        ]);
    }
}
