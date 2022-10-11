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
        // 'name','debit','credit','balance
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('1=active/0=inactive');
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
        Schema::dropIfExists('accounts');
    }
};
