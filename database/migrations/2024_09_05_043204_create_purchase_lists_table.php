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
        Schema::create('purchase_lists', function (Blueprint $table) {
            $table->id();
            $table->string('po_id', 20)->nullable()->comment('รหัสใบสั่งซื้อ');
            $table->string('po_prod_name', 250)->nullable()->comment('ชื่อสินค้า');
            $table->integer('po_prod_quantity')->nullable()->comment('จำนวน/กิโล');
            $table->double('po_prod_price_per_unit')->nullable()->comment('ราคา/หน่วย');
            $table->double('po_prod_price')->nullable()->comment('จำนวนเงิน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_lists');
    }
};
