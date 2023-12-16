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
        Schema::create('devicelocations', function (Blueprint $table) {
            $table->bigIncrements('AIN');
            $table->String('Deviceid');
            $table->String('Lat');
            $table->String('Lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devicelocations');
    }
};
