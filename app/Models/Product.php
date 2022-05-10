<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'price_sale',
        'thumb',
        'quantity',
        'category_id',
        'active'
    ];

    public function menu() {
        return $this->hasOne(Category::class, 'id', 'category_id')
            ->withDefault(['name', '']);
    }
}
