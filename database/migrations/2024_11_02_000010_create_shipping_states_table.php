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
        Schema::create('shipping_states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id')->unsigned();
            $table->unsignedBigInteger('districs_id')->unsigned();
            $table->string('state_name');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('districs_id')->references('id')->on('districs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_states');
    }
};
