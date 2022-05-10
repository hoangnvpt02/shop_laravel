<?php

namespace App\Http\Services\Admin;

use App\Models\Order_Item;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CartServices
{
    public function getCustomer() {
        return DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'users.name', 'users.phone', 'users.email', 'users.address', 'orders.created_at', 'orders.confirm')
            ->orderBy('orders.id')
            ->paginate(10);
    }

    public function getDetailCart($id) {
        return DB::table('order_item')
            ->leftJoin('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_id', $id)
            ->select('order_item.id', 'products.name', 'products.price', 'products.price_sale', 'products.thumb', 'order_item.quantity')
            ->get();
    }

    public function getDetailCustomer($id) {
        return DB::table('users')
            ->where('id', $id)
            ->select('id', 'name', 'phone', 'email', 'address')
            ->get();
    }

    public function destroy($request) {
        $id = $request->input('id');
        $category = Orders::where('id', $id)->first();

        if ($category) {
            Order_Item::where('order_id', $id)->delete();
            return Orders::where('id', $id)->delete();
        }
        return false;
    }

    public function update($request) {
        $confirm = 0;
        $id = $request->input('id');
        $orders = Orders::where('id', $id)->get();
        foreach ($orders as $order) {
            $confirm = $order->confirm;
        }

        if ($confirm != 1) {
            try {
                Orders::where('id', $id)->update(['confirm' => 1]);
                $listOrder_item = Order_Item::where('order_id', $id)->get();
                foreach ($listOrder_item as $order_item) {
                    $listProduct = Product::where('id', $order_item->product_id)->get('quantity');
                    foreach ($listProduct as $product) {
                        if ($product->quantity - $order_item->quantity < 0) {
                            Orders::where('id', $id)->update(['confirm' => 0]);
                            return -1;
                        }
                        Product::where('id', $order_item->product_id)->update(['quantity' => $product->quantity - $order_item->quantity]);
                    }
                }
            } catch (\Exception $err) {
                return false;
            }
        }

        return $confirm;
    }
}
