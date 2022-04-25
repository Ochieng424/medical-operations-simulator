<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\PatientService;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $patients = $this->patientService->getPatients();

        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePatientRequest $request
     * @return JsonResponse
     */
    public function store(StorePatientRequest $request): JsonResponse
    {
        $response = $this->patientService->store($request);

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $patient = Patient::where('patient_number', $id)->first();

        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
