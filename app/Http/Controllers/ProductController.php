<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\Category\CategoryServices;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductServices;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $category;

    public function __construct(ProductServices $productServices, CategoryServices $category)
    {
        $this->productService = $productServices;
        $this->category = $category;
    }

    public function index($id = '', $slug = '') {
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('product.content', [
            'title' => $product->name,
            'product' => $product,
            'categorys' => $this->category->getAll(),
            'products' => $productMore,
            'user' => $user

        ]);
    }
}
