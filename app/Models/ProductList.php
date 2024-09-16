<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_id',
        'prod_name',
        'prod_length',
        'prod_price_per_unit',
        'prod_price',
        'prod_buy_qty',
        'prod_sales_qty',
        'prod_min_qty',
    ];
}
