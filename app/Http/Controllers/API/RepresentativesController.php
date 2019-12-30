<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Representative;
use Illuminate\Http\Request;

class RepresentativesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Representative::all();
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
            'name' => ['required', 'unique:representatives'],
        ]);
            
        return Representative::create([
            'name' => $request->name,
            'division_code' => $request->divisionCode,
            'school_id' => $request->schoolId,
            'region_org_code' => $request->regionOrgCode,
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
    public function update(Request $request, Representative $representative)
    {
        $this->validate($request, [
            'name' => 'required|unique:representatives,name,' . $representative->id,
        ]);

        $representative->update([
            'name' => $request->name,
            'division_code' => $request->division_code,
            'school_id' => $request->school_id,
            'region_org_code' => $request->region_org_code,
        ]);

        return ['message', 'successfully updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representative $representative)
    {
        $representative->delete();

        return ['message' => 'deleted successfully'];
    }
}
