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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_id', 20)->nullable()->comment('รหัสใบสั่งซื้อ');
            $table->string('po_number1', 20)->nullable()->comment('เล่มที่');
            $table->string('po_number2', 20)->nullable()->comment('เลขที่');
            $table->date('po_date')->nullable()->comment('วันที่');
            $table->string('po_company_name',200)->nullable()->comment('ชื่อบริษัท');
            $table->string('po_company_address', 250)->nullable()->comment('ที่อยู่บริษัท');
            $table->string('po_company_tel', 10)->nullable()->comment('เบอร์โทรบริษัท');
            $table->string('po_company_fax', 10)->nullable()->comment('แฟรกซ์');
            $table->string('po_company_taxpayer_number', 13)->nullable()->comment('เลขผู้เสียภาษี');
            $table->double('po_total_price')->nullable()->comment('รวมราคาสินค้า');
            $table->double('po_vat')->nullable()->comment('ภาษีมูลค่าเพิ่ม 7%');
            $table->double('po_net_price')->nullable()->comment('รวมเงินทั้งสิ้น');
            $table->text('po_note')->nullable()->comment('หมายเหตุ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
