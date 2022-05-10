<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\Category\CategoryServices;
use App\Http\Services\Product\ProductServices;
use App\Http\Services\Product\ProductAdminServices;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    protected $category;
    protected $product;
    protected $products;
    public function __construct(CategoryServices $category, ProductServices $product, ProductAdminServices $products)
    {
        $this->category = $category;
        $this->product = $product;
        $this->products = $products;
    }

    public function index() {
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('home', [
            'title' => "Trang chủ",
            'categorys' => $this->category->getAll(),
            'product' => $this->product->get(),
            'products' => $this->products->get(),
            'user' => $user
        ]);
    }
}
