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
        {
            Schema::dropIfExists('alerts');
            Schema::create('alerts', function (Blueprint $table) {
                $table->bigIncrements('unique');
                $table->string('incidentid');
                $table->string('Status');
                $table->string('locationLat');
                $table->string('locationLong');
                $table->string('type');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
