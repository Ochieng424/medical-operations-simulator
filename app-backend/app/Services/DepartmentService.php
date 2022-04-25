<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function fetchDepartments()
    {
        $departmentsReferrals = [
            'Nurse' => [4],
            'Lab Technician' => [4],
            'Radiologist' => [4],
            'Doctor' => [2, 3, 5],
            'Optician' => [4],
            'Receptionist' => [1],
        ];

        $user = auth()->user();
        $ids = $departmentsReferrals[$user->role];

        return Department::whereIn('id', $ids)->get();
    }
}
