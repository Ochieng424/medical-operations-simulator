<?php

namespace App\Services;

use App\Models\Patient;

class PatientService
{
    public function getPatients()
    {
        return Patient::latest('id')->paginate(10);
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
}
