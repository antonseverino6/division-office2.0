<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\EmployeePersonalDetail;
use App\EmployeeEmploymentDetail;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Employees\AddEmployeeRequest;
use App\Http\Requests\Employees\UpdateEmployeeRequest;

class EmployeePersonalDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddEmployeeRequest $request)
    {

        $emp = EmployeePersonalDetail::create([
            'user_id' => $request->user_id,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'suffix' => $request->suffix,
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'civil_status_id' => $request->civil_status_id,
            'per_address' => $request->per_address,
            'phone_num' => $request->phone_num,
            'email' => $request->email,
            'created_by' => auth('api')->user()->id,
            'representative_id' => auth('api')->user()->representative_id,
        ]);

        if ($emp) {
            EmployeeEmploymentDetail::create([
                'employee_personal_detail_id' => $emp->id,
                'employee_id' => $request->employee_id,
                'role_type' => $request->role_type,
                'employment_status_id' => $request->employment_status_id,
                'job_code' => $request->job_code,
                'date_join' => $request->date_join,
                'date_appoint' => $request->date_appoint,
                'work_shift' => $request->work_shift,
                'biometric' => $request->biometric,
                'item_num' => $request->item_num,
            ]);

            $jayson = ['emp_id' => $emp->id];

            if ($request->image) {
                $imageData = $request->image;
                $name = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                // $request->merge(['image' => $name]);
                array_push($jayson,['image' => $name]);
                // $name->store('profile','public');
                Image::make($request->image)->save(public_path('img/profile/').$name);
                $emp->update(['image' => $name]);
                // $image->save();
                // store('profile','public')
            }

            return $jayson;

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, EmployeePersonalDetail $employee)
    {
        $currentPhoto = $employee->image;

        $employee_profile = $employee->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'suffix' => $request->suffix,
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'civil_status_id' => $request->civil_status_id,
            'per_address' => $request->per_address,
            'phone_num' => $request->phone_num,
            'email' => $request->email,
        ]);

        

        if ($employee_profile) {
            $employee->employeeEmploymentDetail()->update([
                'employee_id' => $request->employee_id,
                'role_type' => $request->role_type,
                'employment_status_id' => $request->employment_status_id,
                'job_code' => $request->job_code,
                'date_join' => $request->date_join,
                'date_appoint' => $request->date_appoint,
                'work_shift' => $request->work_shift,
                'biometric' => $request->biometric,
                'item_num' => $request->item_num,  
            ]);

            if ($request->image != $currentPhoto) {
                $imageData = $request->image;
                $name = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->image)->save(public_path('img/profile/').$name);
    
                // $request->photo = $name;
                // $request->merge(['image' => $name]);

                $employee->update(['image' => $name]);
                if ($currentPhoto != 'default_userprofile.png') {
                    $userPhoto = public_path('img/profile/').$currentPhoto;
                    if (file_exists($userPhoto)) {
                        
                        @unlink($userPhoto);
                    } 
                }
  

                return ['id' => $employee->id];
                
    
            } 

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
