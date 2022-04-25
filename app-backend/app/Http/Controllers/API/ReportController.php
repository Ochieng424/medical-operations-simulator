<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function departments(): JsonResponse
    {
        $departments = Department::all();

        return response()->json($departments);
    }

    public function filter(Request $request): JsonResponse
    {
        $query = (new Patient())->newQuery();

        $search = $request->search;
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        $date = $request->date;
        if ($date) {
            $query->whereHas('checkIns', function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            });
        }

        $department = $request->department;
        if ($department) {
            $query->with(['treatments' => function ($query) use ($department) {
                return $query->where('department_id', $department);
            }])->whereHas('treatments', function ($query) use ($department) {
                $query->where('department_id', $department);
            });
        }else{
            $query->with('treatments');
        }

        $patients = $query->get();

        return response()->json($patients);
    }
}
