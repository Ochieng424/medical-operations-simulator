<?php

namespace App\Services;

use App\Models\CheckIn;
use App\Models\Treatment;
use Illuminate\Support\Facades\DB;

class CheckInService
{
    public function checkIn($patient_id, $department_id, $notes)
    {
        if ($this->hasOpenCheckIn($patient_id)) {
            return false;
        }

        try {
            DB::transaction(function () use ($patient_id, $department_id, $notes) {
                $checkIn = new CheckIn();
                $checkIn->patient_id = $patient_id;
                $checkIn->check_in_number = $this->generateCheckInNumber();
                $checkIn->checked_in_by_id = auth()->user()->id;
                $checkIn->save();

                $this->createTreatment($checkIn->id, $patient_id, $department_id, $notes);
            });
            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function hasOpenCheckIn($patient_id)
    {
        return CheckIn::where('patient_id', $patient_id)
            ->where('status', 'open')
            ->exists();
    }

    private function generateCheckInNumber(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function createTreatment($check_in_id, $patient_id, $department_id, $notes)
    {
        try {
            $user = auth()->user();
            $treatment = new Treatment();
            $treatment->check_in_id = $check_in_id;
            $treatment->patient_id = $patient_id;
            $treatment->department_id = $user->department_id;
            $treatment->department_practitioner_id = $user->id;
            $treatment->department_ref_id = $department_id;
            $treatment->notes = $notes;
            $treatment->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
