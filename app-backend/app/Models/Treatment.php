<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $with = ['medicalPractitioner', 'department', 'dept'];

    public function medicalPractitioner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'department_practitioner_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function dept(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_ref_id');
    }

}
