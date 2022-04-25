<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(): JsonResponse
    {
        $departments = $this->departmentService->fetchDepartments();

        return response()->json($departments);
    }
}
