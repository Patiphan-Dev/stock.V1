<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesList extends Model
{
    use HasFactory;
    protected $fillable = [
        'so_id',
        'so_prod_name',
        'so_prod_quantity',
        'so_prod_price_per_unit',
        'so_prod_price',
        'so_prod_length',
        'so_prod_total_length',
    ];

    public function product()
    {
        return $this->belongsTo(ProductList::class, 'so_prod_name', 'prod_name'); // Adjust foreign keys as necessary
    }
}
