<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathology_patient_id')->constrained('pathology_patients')->onDelete('cascade');
            $table->foreignId('pathology_test_id')->constrained('pathology_tests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_test');
    }
};
