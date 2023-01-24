<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName',
        'productPrice',
        'productModal',
        'category_id',
        'unit_id',
        'inStock',
        'isActive'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
