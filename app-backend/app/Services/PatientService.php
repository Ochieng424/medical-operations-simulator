<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientService
{
    public function getPatients(Request $request)
    {
        $user = auth()->user();
        $query = (new Patient())->newQuery();

        $search = $request->search;
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        if ($user->role != 'Receptionist') {
            $query->whereHas('currentDepartment', function ($query) use ($user) {
                $query->where('department_ref_id', $user->department_id);
            })->whereHas('currentCheckIn', function ($query) use ($user) {
                $query->where('status', 'open');
            });
        }

        return $query->latest()->paginate(10);
    }

    public function store($request)
    {
        try {
            $patient = new Patient();
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->residence = $request->residence;
            $patient->created_by_id = $request->user()->id;
            $patient->patient_number = time();
            $patient->save();

            return $patient;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPatient($id)
    {
        return Patient::where('patient_number', $id)->with('currentCheckIn.treatments')->first();
    }
}
