<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\LevelsOfCivil;
use Illuminate\Http\Request;

class LevelsOfCivilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LevelsOfCivil::all();
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
            'name' => 'required|unique:levels_of_civils',
        ]);

        LevelsOfCivil::create([
            'name' => $request->name,
        ]);

        return ['message' => 'created successfully'];
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
    public function update(Request $request, LevelsOfCivil $levelsOfCivil)
    {
        $this->validate($request, [
            'name' => 'required|unique:levels_of_civils,name,' . $request->id,
        ]);

        $levelsOfCivil->update([
            'name' => $request->name,
        ]);

        return ['message' => 'updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelsOfCivil $levelsOfCivil)
    {
        $levelsOfCivil->delete();

        return ['message' => 'deleted successfully'];
    }
}
