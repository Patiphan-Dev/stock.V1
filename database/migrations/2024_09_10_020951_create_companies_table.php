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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable()->comment('ชื่อบริษัท');
            $table->string('company_address', 250)->nullable()->comment('ที่อยู่บริษัท');
            $table->string('company_tel', 10)->nullable()->comment('เบอร์โทรบริษัท');
            $table->string('company_fax', 10)->nullable()->comment('แฟรกซ์');
            $table->string('company_taxpayer_number', 10)->nullable()->comment('เลขผู้เสียภาษี');
            $table->string('company_logo')->nullable()->comment('โลโก้บริษัท');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
