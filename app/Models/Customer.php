<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function customergroup()
    {
        return $this->belongsTo(Customer_group::class, 'customer_group_id', 'id');
    }
}
