<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryServices
{
    public function getParent() {
        return Category::where('parent_id', 0)->get();
    }

    public function getAll() {
        return Category::orderBy('id')->paginate(20);
    }

    public function create($request) {
        try {
            Category::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'active' => (string) $request->input('active'),
            ]);
            Session::flash('success', 'Tạo Danh Mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($category, $request) : bool {
        if ($request->input('parent_id') != $category->id) {
            $category->parent_id = (int) $request->input('parent_id');
        }

        $category->name = (string) $request->input('name');
        $category->description = (string) $request->input('description');
        $category->active = (int) $request->input('active');
        $category->save();
        Session::flash('success', 'Cập nhật thành công Danh Mục');
        return true;
    }

    public function destroy($request) {
        $id = $request->input('id');
        $category = Category::where('id', $id)->first();

        if ($category) {
            return Category::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function getId($id) {
        return Category::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($category) {
        return DB::table('products')
            ->leftJoin('categorys', 'products.category_id', '=', 'categorys.id')
            ->select('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.thumb', 'products.quantity')
            ->where('products.active', 1)
            ->where('category_id', $category->id)
            ->orWhere('parent_id', $category->id)
            ->orderBy('id')
            ->paginate('12');
    }
}
