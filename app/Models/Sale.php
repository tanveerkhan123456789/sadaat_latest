<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    public function ware()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }


    public function productsales()
    {
        return $this->hasMany(Purchase_product::class, 'purchase_id','id');
    }

}
