<?php

namespace App\Http\Services;

use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    public function getListOrder($id) {
        return Orders::where('user_id', $id)->get();
    }

    public function getOrder($id) {
        return DB::table('order_item')
            ->leftJoin('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_id', $id)
            ->select('order_item.id', 'products.name', 'products.price', 'products.price_sale', 'products.thumb', 'order_item.quantity')
            ->get();
    }
}
