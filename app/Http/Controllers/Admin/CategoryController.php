<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Http\Services\Category\CategoryServices;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    public function create() {
        $user = Auth::user();
        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }
        return view('admin.category.add', [
            'title' => 'Thêm danh mục mới',
            'categorys' => $this->categoryServices->getParent(),
            'user' => $user
        ]);
    }

    public function store(CreateFormRequest $request) {
        $this->categoryServices->create($request);
        return redirect()->back();
    }

    public function index() {
        $user = Auth::user();
        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }
        return view('admin.category.list', [
            'title' => 'Danh sách Danh Mục',
            'categorys' => $this->categoryServices->getAll(),
            'user' => $user
        ]);
    }

    public function show(Category $category) {
        $user = Auth::user();
        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }
        return view('admin.category.edit', [
            'title' => 'Chỉnh sửa Danh Mục ' . $category->name,
            'category' => $category,
            'categorys' => $this->categoryServices->getParent(),
            'user' => $user
        ]);
    }

    public function update(Category $category, CreateFormRequest $request) {
        $this->categoryServices->update($category, $request);

        return redirect('/admin/categorys/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryServices->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
