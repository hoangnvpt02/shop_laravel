<?php

namespace App\Http\Services;



use App\Models\Order_Item;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartServices
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct() {
        $carts = Session::get('carts');

        if (is_null($carts))
            return [];

        $productId = array_keys($carts);

        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request) {
        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id) {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request) {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            $order = Orders::create([
                'user_id' => Auth::id(),
                'confirm' => 0
            ]);

            $this->infoProductCart($carts, $order->id);
            DB::commit();
            Session::flash('success', 'Đặt hàng thành công !!!');
            Session::forget('carts');
        } catch (\Exception $err) {
            dd($err);
            DB::rollBack();
            Session::flash('error', 'Đặt hàng lỗi, vui lòng thử lại sau !!!');
            return false;
        }

        return true;
    }

    protected function infoProductCart($carts, $order_id) {
        $productId = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'product_id' => $product->id,
                'order_id' => $order_id,
                'quantity' => $carts[$product->id],
            ];
        }

        return Order_Item::insert($data);
    }


}
