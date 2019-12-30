<?php

namespace App\Http\Controllers\API;

use App\EmployeeBase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeBase::with('typeOfEmployee')
                            ->orderBy('type_of_employee_id')
                            ->get();
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'employeeType' => 'required',
        ]);

        return EmployeeBase::create([
            'name' => $request->name,
            'type_of_employee_id' => $request->employeeType,
        ]);
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
    public function update(Request $request, EmployeeBase $employeeBase)
    {
        $this->validate($request, [
            'name' => 'required',
            'type_of_employee_id' => 'required',
        ]);


        $employeeBase->update([
            'name' => $request->name,
            'type_of_employee_id' => $request->type_of_employee_id,
        ]);

             return ['message' => 'updated successfully'];

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeBase $employeeBase)
    {
        $employeeBase->delete();

        return ['message' => 'deleted successfully'];
    }
}
