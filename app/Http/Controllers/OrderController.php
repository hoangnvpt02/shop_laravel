<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\Category\CategoryServices;
use App\Http\Services\OrderServices;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    protected $orderServices;
    protected $category;

    public function __construct(OrderServices $orderServices, CategoryServices $category)
    {
        $this->orderServices = $orderServices;
        $this->category = $category;
    }

    public function index() {
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('order.index', [
            'title' => 'Các đơn đặt hàng',
            'categorys' => $this->category->getAll(),
            'user' => $user,
            'listOrders' => $this->orderServices->getListOrder($user->id)
        ]);
    }

    public function show(Orders $orders) {
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('order.detail', [
            'title' => 'Chi tiết đơn đạt hàng',
            'categorys' => $this->category->getAll(),
            'user' => $user,
            'orders' => $this->orderServices->getOrder($orders->id)
        ]);
    }
}
