<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'so_id',
        'so_number',
        'so_date',
        'so_customer_name',
        'so_customer_address',
        'so_customer_taxpayer_number',
        'so_total_price',
        'so_vat',
        'so_net_price',
        'so_note',
    ];

    public function product()
    {
        return $this->belongsTo(ProductList::class, 'so_prod_name', 'prod_name'); // Adjust foreign keys as necessary
    }

    public function saleslist()
    {
        return $this->belongsTo(SalesList::class, 'so_id', 'so_id'); // Adjust foreign keys as necessary
    }
}
