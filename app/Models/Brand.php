<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public function catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id','id');
    }
}
