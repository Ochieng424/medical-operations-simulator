<?php

use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string('status')->default('open');
            $table->string('check_in_number')->unique();
            $table->unsignedBigInteger('checked_in_by_id')->nullable();
            $table->timestamps();

            $table->foreign('checked_in_by_id')->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_ins');
    }
}
