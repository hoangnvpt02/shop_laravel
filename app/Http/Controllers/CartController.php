<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\CartServices;
use App\Http\Services\Category\CategoryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartServices;
    protected $category;

    public function __construct(CartServices $cartServices, CategoryServices $category)
    {
        $this->cartServices = $cartServices;
        $this->category = $category;
    }

    public function index(Request $request) {
        $result = $this->cartServices->create($request);
        if ($result === false) {
            $request->session()->flash('error', 'Thêm vào giỏ hàng không thành công');
            return redirect()->back();
        }
        $request->session()->flash('success', 'Đã thêm vào giỏ hàng');
        return redirect()->back();
    }

    public function show() {
        $products = $this->cartServices->getProduct();
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('carts.list', [
            'title' => 'Danh sách Giỏ Hàng',
            'categorys' => $this->category->getAll(),
            'products' => $products,
            'carts' => Session::get('carts'),
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $this->cartServices->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0) {
        $this->cartServices->remove($id);

        return redirect('/carts');
    }

    public function addCart(Request $request) {
        $this->cartServices->addCart($request);
        return redirect()->back();
    }
}
