<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Position::with('typeOfEmployee')
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

        return Position::create([
            'name' => $request->name,
            'type_of_employee_id' => $request->employeeType,
            'subject' => 0,
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
    public function update(Request $request, Position $position)
    {
        $this->validate($request, [
            'name' => 'required',
            'type_of_employee_id' => 'required',
        ]);

        $position->update([
            'name' => $request->name,
            'type_of_employee_id' => $request->type_of_employee_id,
        ]);
    }

    public function link_subject(Request $request, Position $position) 
    {

        $position->update([
            'subject' => ! $position->subject,
        ]);

        return ['message' => 'updated successfully'];

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return ['message' => 'deleted successfully'];
    }
}
