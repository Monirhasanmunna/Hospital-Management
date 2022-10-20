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
        Schema::create('reffered_amount_details', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('refd_amount');
            $table->integer('refd_paid_amount')->nullable();
            $table->integer('doctor_paid')->nullable();
            $table->integer('co_paid')->nullable();
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
        Schema::dropIfExists('reffered_amount_details');
    }
};
