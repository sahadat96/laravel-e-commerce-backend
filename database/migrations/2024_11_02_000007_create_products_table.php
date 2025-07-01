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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->unsigned();
            $table->unsignedBigInteger('cat_id')->unsigned();
            $table->unsignedBigInteger('sub_cat_id')->unsigned();
            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->string('product_name');
            $table->string('slug');
            $table->string('product_image');
            $table->string('product_code')->unique();
            $table->float('product_price');
            $table->float('discount')->nullable();
            $table->float('discount_price');
            $table->float('delivery_Charge')->nullable(); 
            $table->text('short_desc');
            $table->string('product_tags');
            $table->string('product_size');
            $table->string('product_color');
            $table->longText('long_desc');
            $table->string('hot_deal')->nullable();
            $table->string('special_offer')->nullable();
            $table->string('special_deal')->nullable();
            $table->string('featured')->nullable();
            $table->string('thumb')->nullable();
            $table->integer('quantity');
            $table->string('operator_phone');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('sub_cat_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
