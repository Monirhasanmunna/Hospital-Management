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
        Schema::create('pathology_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('pathology_categories')->onDelete('cascade');
            $table->integer('code')->unique();
            $table->string('name');
            $table->integer('standard_rate');
            $table->integer('refd_percent')->default(0);
            $table->integer('refd_amount');
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
        Schema::dropIfExists('pathology_tests');
    }
};
