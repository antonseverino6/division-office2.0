<?php

namespace App\Http\Controllers\API;

use App\CivilStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CivilStatusController extends Controller
{
    public function index()
    {
        return CivilStatus::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:civil_statuses',
        ]);

        return CivilStatus::create([
            'name' => $request->name,
        ]);
    }

    public function update(Request $request, CivilStatus $civilStatus)
    {
        $this->validate($request, [
            'name' => 'required|unique:civil_statuses,name,'. $request->id,
        ]);

        $civilStatus->update([
            'name' => $request->name,
        ]);
    }

    public function destroy(CivilStatus $civilStatus) 
    {
        $civilStatus->delete();
    }
}
