<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_id',
        'po_number1',
        'po_number2',
        'po_date',
        'po_company_name',
        'po_company_address',
        'po_company_tel',
        'po_company_fax',
        'po_company_taxpayer_number',
        'po_total_price',
        'po_vat',
        'po_net_price',
        'po_note',
    ];
}
