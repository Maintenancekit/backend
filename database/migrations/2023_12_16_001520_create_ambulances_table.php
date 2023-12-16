<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('ambulances');
        Schema::create('ambulances', function (Blueprint $table) {
            $table->bigIncrements('unique');
            $table->string('companyid');
            $table->string('companycolor');
            $table->string('vehicleid');
            $table->string('email');
            $table->string('type');
            $table->string('currentstatus');
            $table->string('Deviceid');
            $table->string('isadmin');
            $table->string('isactive');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
