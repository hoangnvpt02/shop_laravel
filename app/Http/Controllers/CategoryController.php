<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryServices;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    public function index(Request $request, $id, $slug = '') {
        $category = $this->categoryServices->getId($id);

        $products = $this->categoryServices->getProduct($category);
        $user = Auth::user();

        $result = Helper::accountIsUser();
        if ($result != false) {
            return $result;
        }

        return view('menu', [
            'title' => $category->name,
            'products' => $products,
            'categorys' => $this->categoryServices->getAll(),
            'user' => $user
        ]);
    }
}
