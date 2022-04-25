<?php

use App\Models\CheckIn;
use App\Models\Department;
use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CheckIn::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->unsignedBigInteger('department_practitioner_id')->nullable();
            $table->unsignedBigInteger('department_ref_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('department_practitioner_id')->references('id')
                ->on('users')->onDelete('set null');
            $table->foreign('department_ref_id')->references('id')
                ->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
