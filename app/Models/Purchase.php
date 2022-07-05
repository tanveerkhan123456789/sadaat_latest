<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id','id');
    }
    public function product_purchase()
    {
        return $this->hasMany(Purchase_product::class, 'purchase_id','id');
    }

    public function product_sale()
    {
        return $this->hasMany(ProductSale::class, 'sale_id','id');
    }

    public function ware()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }
    
   
}
