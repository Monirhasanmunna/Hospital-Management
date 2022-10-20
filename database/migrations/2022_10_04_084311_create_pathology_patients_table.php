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
            $table->foreignId('doctor_id')->constrained('pathology_doctors')->onDelete('cascade');
            $table->string('name');
            $table->string('mobile');
            $table->integer('age');
            $table->bigInteger('invoice_total');
            $table->bigInteger('tax')->nullable();
            $table->bigInteger('tax_amount')->nullable();
            $table->bigInteger('total_amount');
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('discount_amount')->nullable();
            $table->bigInteger('paid_amount');
            $table->bigInteger('due_amount')->nullable();
            $table->string('address');
            $table->tinyInteger('is_refferel_paid')->default(0);
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
