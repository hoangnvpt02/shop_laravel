<?php

namespace App\Http\Controllers\Sale;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\CartServices;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    protected $cart;

    public function __construct(CartServices $cart)
    {
        $this->cart = $cart;
    }

    public function index() {
        $user = Auth::user();

        $result = Helper::accountIsSale();
        if ($result != false) {
            return $result;
        }

        return view('sale.main', [
            'title' => 'Sale',
            'user' => $user
        ]);
    }

    public function list() {
        $user = Auth::user();

        $result = Helper::accountIsSale();
        if ($result != false) {
            return $result;
        }

        return view('sale.customer', [
            'title' => 'Danh sách Đợn Hàng',
            'user' => $user,
            'customers' => $this->cart->getCustomer()
        ]);
    }

    public function show(Orders $orders) {
        $user = Auth::user();

        $result = Helper::accountIsSale();
        if ($result != false) {
            return $result;
        }

        return view('sale.detail', [
            'title' => 'Chi tiết đơn hàng',
            'user' => $user,
            'customers' => $this->cart->getDetailCustomer($orders->user_id),
            'orders' => $this->cart->getDetailCart($orders->id),
            'order_time' => $orders->created_at
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->cart->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Hủy đơn hàng thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function update(Request $request) {
        $result = $this->cart->update($request);

        if ($result == 0) {
            return response()->json([
                'error' => false,
                'message' => 'Xác nhận đơn hàng thành công'
            ]);
        }

        if ($result == -1) {
            return response()->json([
                'error' => false,
                'message' => 'Mặt hàng trong đơn hiện tại trong kho không có đủ'
            ]);
        }

        if ($result == 1) {
            return response()->json([
                'error' => false,
                'message' => 'Đơn hàng đã xác nhận rồi'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
