<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminServices;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productServices;

    public function __construct(ProductAdminServices $productServices)
    {
        $this->productServices = $productServices;
    }

    public function index()
    {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productServices->get(),
            'user' => $user
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm mới',
            'categorys' => $this->productServices->getMenu(),
            'user' => $user
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productServices->insert($request);

        return redirect()->back();
    }

    public function show(Product $product)
    {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa Sản Phẩm',
            'product' => $product,
            'menus' => $this->productServices->getMenu(),
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(ProductRequest $request,Product $product)
    {
        $result = $this->productServices->update($request, $product);
        if ($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->productServices->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
