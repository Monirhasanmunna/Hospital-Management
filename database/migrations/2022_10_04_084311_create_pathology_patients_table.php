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
        Schema::create('pathology_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained('pathology_referrals')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('pathology_doctor')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('pathology_tests')->onDelete('cascade');
            $table->string('name');
            $table->string('mobile');
            $table->string('age');
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
        Schema::dropIfExists('pathology_patients');
    }
};
