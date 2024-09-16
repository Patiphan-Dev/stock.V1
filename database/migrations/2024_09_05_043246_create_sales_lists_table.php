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
        Schema::create('sales_lists', function (Blueprint $table) {
            $table->id();
            $table->string('so_id', 20)->nullable()->comment('รหัสใบสั่งขาย');
            $table->string('so_prod_name', 250)->nullable()->comment('รายการสินค้า');
            $table->double('so_prod_length')->nullable()->comment('ยาว(ม.)');
            $table->integer('so_prod_quantity')->nullable()->comment('จำนวน');
            $table->double('so_prod_total_length')->nullable()->comment('รวมยาว');
            $table->double('so_prod_price_per_unit')->nullable()->comment('ราคาหน่วยละ');
            $table->double('so_prod_price')->nullable()->comment('จำนวนเงิน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_lists');
    }
};
