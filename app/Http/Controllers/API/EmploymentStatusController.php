<?php

namespace App\Http\Controllers\API;

use App\EmploymentStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmploymentStatusController extends Controller
{
    public function index() 
    {   
        return EmploymentStatus::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:employment_statuses',
        ]);

        return EmploymentStatus::create([
            'name' => $request->name,
        ]);
    }

    public function update(Request $request, EmploymentStatus $employmentStatus)
    {
        $this->validate($request, [
            'name' => 'required|unique:employment_statuses,name,' . $request->id,
        ]);

        $employmentStatus->update([
            'name' => $request->name,
        ]);

        return ['message' => 'employment status updated successfully'];
    }

    public function destroy(EmploymentStatus $employmentStatus)
    {
        $employmentStatus->delete();

        return ['message' => 'employment status deleted successfully'];
    }
}
