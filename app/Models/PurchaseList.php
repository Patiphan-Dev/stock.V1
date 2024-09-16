<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseList extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_id',
        'po_prod_name',
        'po_prod_quantity',
        'po_prod_price_per_unit',
        'po_prod_price'
    ];
}
