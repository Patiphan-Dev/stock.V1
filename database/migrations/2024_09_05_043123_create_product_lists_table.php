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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->id();
            $table->string('po_id', 20)->nullable()->comment('รหัสใบสั่งซื้อ');
            $table->string('prod_name', 100)->nullable()->comment('ชื่อสินค้า');
            $table->string('prod_unit')->nullable()->comment('หน่วย');
            $table->double('prod_length')->nullable()->comment('ความยาว');
            $table->double('prod_price_per_unit')->nullable()->comment('ราคาต่อหน่วย');
            $table->integer('prod_buy_qty')->nullable()->comment('จำนวนสินค้าซื้อมา');
            $table->integer('prod_sales_qty')->nullable()->comment('จำนวนสินค้าที่ขายไป');
            $table->integer('prod_min_qty')->nullable()->comment('จำนวนสินค้าคงเหลือ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_lists');
    }
};
