<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function checkIns(): HasMany
    {
        return $this->hasMany(CheckIn::class);
    }

    public function currentDepartment(): HasOne
    {
        return $this->hasOne(Treatment::class)->latestOfMany();
    }

    public function currentCheckIn(): HasOne
    {
        return $this->hasOne(CheckIn::class)->latestOfMany();
    }
}
