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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('description')->nullable();
            $table->string('office_address')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('operator_name')->nullable();
            $table->string('opeartor_phone')->unique()->nullable();
            $table->string('tin')->unique()->nullable();
            $table->string('pic')->nullable();
            $table->string('vendor_join_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user', 'vendor'])->default('vendor');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
