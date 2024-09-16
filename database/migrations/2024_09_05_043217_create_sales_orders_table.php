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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('so_id', 20)->nullable()->comment('รหัสใบสั่งขาย');
            $table->string('so_number', 30)->nullable()->comment('เลขที่');
            $table->date('so_date', 20)->nullable()->comment('วันที่');
            $table->string('so_customer_name', 100)->nullable()->comment('ชื่อลูกค้า');
            $table->string('so_customer_address', 250)->nullable()->comment('ที่อยู่ลูกค้า');
            $table->string('so_customer_taxpayer_number', 13)->nullable()->comment('เลขประจำตัวผู้เสียภาษี');
            $table->double('so_total_price', 10)->nullable()->comment('รวมราคาสินค้า');
            $table->double('so_vat', 10)->nullable()->comment('ภาษีมูลค่าเพิ่ม 7%');
            $table->double('so_net_price', 10)->nullable()->comment('รวมเงินทั้งสิ้น');
            $table->text('so_note', 250)->nullable()->comment('หมายเหตุ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
